$.fn.transmitData = function(options){
    var formObject = $(this);

    var settings = $.extend({
        file: false,
        formReset: true,
        progress: false,
        progressCallback: function(percent){},
        redirectPath: null,
        redirectDelay: 2000,
        modifyFieldKey: {},
        alert: {
            show: true,
            successTitle: 'Success!'
        },
        errorSelectAttributeName: 'name',
        errorClass: 'is-invalid',
        inputRoot: '.form-group',
        showFormErrorsWhenStatusCode: 422,
        formSubmitUrl: formObject.attr('action'),
        formSubmitMethod: formObject.attr('method'),
        successCallback: function(result,status,xhr){},
        submittingCallback: function(){},
        completeRequest: function(){},
        errorCallback: null,
        showErrorCallback: function(error, key){
            if(Object.keys(settings.modifyFieldKey).length > 0){
                if(settings.modifyFieldKey.hasOwnProperty(key)){
                    key = settings.modifyFieldKey[key];
                }
            }
            var item;
            if(key.split('.').length == 2){
                item = $('[' + settings.errorSelectAttributeName + '="' + key.split('.')[0] +'[]"]');
            }else{
                item = $('[' + settings.errorSelectAttributeName + '="' + key +'"]');
            }
            item.addClass(settings.errorClass).parent().append('<p class="invalid-feedback">'+ error +'</p>');
        },
        beforeSubmitCallback: function(xhr){
            settings.submittingCallback();
            formObject.find('button').attr('disabled', true);
            formObject.find('.'+settings.errorClass).removeClass(settings.errorClass);
            formObject.find('.invalid-feedback').remove();
        }
    }, options);
    formObject.submit(function(e){
        e.preventDefault();
        var formObject = $(this);
        var ajaxOption = {
            url: formObject.attr('action'),
            type: formObject.attr('method'),
            dataType: 'json',
            data: formObject.serializeArray(),
            beforeSend: function(xhr){
                settings.beforeSubmitCallback(xhr);
            }
        };
        if(settings.file){
            ajaxOption.cache = false;
            ajaxOption.contentType = false;
            ajaxOption.processData = false;
            ajaxOption.data = new FormData(this);
        }
        if(settings.progress){
            ajaxOption.xhr = function(){
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(event){
                    if(event.lengthComputable){
                        settings.progressCallback(parseInt((event.loaded / event.total) * 100));
                    }
                });
                return xhr;
            }
        }
        ajaxOption.success = function(result,status,xhr){
            if(settings.alert.show){
                swal(settings.alert.successTitle, result.message, 'success');
            }
            if(settings.redirectPath){
                setTimeout(function(){
                    document.location = settings.redirectPath;
                }, settings.redirectDelay);
            }
            if(settings.formReset){
                formObject.get(0).reset();
            }
            settings.successCallback(result,status,xhr);
        };
        ajaxOption.error = function(errors){
            if(typeof settings.errorCallback == 'function'){
                settings.errorCallback(errors);
                return;
            }

            if(errors.status === settings.showFormErrorsWhenStatusCode){
                $.each(errors.responseJSON.errors, function(index, error){
                    settings.showErrorCallback(error[0], index);
                });
            }else{
                swal(errors.status + '!', errors.statusText, 'error');
            }
        };
        ajaxOption.complete = function(){
            settings.completeRequest();
            formObject.find('button').removeAttr('disabled');
        };
        $.ajax(ajaxOption);
    });

};

$.fn.addClassOnSelect = function(options){
    var settings = $.extend({
        activeValue: null
    }, options);
    $(this).each(function(index, value){
        var option = $(value);
        if(option.val() == settings.activeValue){
            option.attr('selected', true);
            return;
        }
    });
}

$.fn.requestRemoveData = function(options){
    var settings = $.extend({
        formToken: null,
        warningMessage: 'Are you sure delete this data?',
        warningTitle: 'Warning!',
        removeParentEelement: 'tr',
        removeItem: function(item){
            item.parents(settings.removeParentEelement).remove();
        },
        requestType: 'DELETE'
    }, options);
    $(this).click(function(e){
        e.preventDefault();
        var item = $(this);

        swal({
            title: settings.warningTitle,
            text: settings.warningMessage,
            buttons: true,
            dangerMode: true
        }).then(function(willDelete){
            if(willDelete){
                $.ajax({
                    url: item.attr('href'),
                    type: settings.requestType,
                    dataType: 'json',
                    data: {
                        _token: settings.formToken
                    },
                    success: function(response){
                        settings.removeItem(item);
                        swal('Success', response.message, 'success');
                    },
                    error: function(xhr,status,error){
                        swal(status + '!', error, 'error');
                    }
                });
            }
        });
    });
}