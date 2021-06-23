var map;
var myLatLng;
var service_id;
// $(document).ready(function() {
//     //geoLocationInit();
// });
function geoLocationInit(ser_id) {
    set_service(ser_id);
    var check_session = sessionStorage.getItem("latitude");
    //console.log(session);
    if(check_session==null){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail);
        } else {
            alert("Browser not supported");
        }
    }else{
        let sessionPos = {
        coords: {
            latitude:sessionStorage.getItem("latitude"),
            longitude:sessionStorage.getItem("longitude"),
        },
    };
    success(sessionPos);
    }



}

function success(position) {
    //console.log(position);
    sessionStorage.setItem("latitude", position.coords.latitude);
    sessionStorage.setItem("longitude", position.coords.longitude);

    var latval = position.coords.latitude;
    var lngval = position.coords.longitude;

    myLatLng = new google.maps.LatLng(latval, lngval);
    //console.log(myLatLng);
    createMap(myLatLng);
    // nearbySearch(myLatLng, "school");
    searchVendors(latval,lngval);
    $('#vendorModal').modal('show');
}

function fail() {
    alert("Please Allow Location Access To Take Service");
}
//set service id
function set_service(ser_id) {
    this.service_id=ser_id;
}
//get service id
function get_service() {
    return this.service_id;
}
//Create Map
function createMap(myLatLng) {
    map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 14,
    });
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Marker-Outside-Azure-icon.png',
        title: "My Place"
    });
}
//Create marker
function createMarker(latlng, icn, name,content) {
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: icn,
        title: name
    });

    var infoWindow = new google.maps.InfoWindow({
        content:content,
    });

    marker.addListener('click', function(){
        infoWindow.open(map, marker);
    });
}

function searchVendors(lat,lng){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/service/vendor/near/list',
        method: 'post',
        data: {
            lat:lat,
            lng:lng,
            service_id:get_service(),
        },
        success: function(data){
           if (data.response.length==0){
               $('#exampleModalLongTitle').html('No Vendor Near You');
               $('.near_venodr_list').html(`<div class="row">
                                            <div class="col-md-12 text-center">
                                                <p class="font-weight-light p-5">Empty Vendot List</p>
                                            </div>
                                        </div>`);
           }
           else{
               var i;
               $('.near_venodr_list').empty();
               for(i=0;i<data.response.length;i++){
                   console.log(data.response[i].shop_name);
                   var glatval=data.response[i].lat;
                   var glngval=data.response[i].lng;
                   var gname=data.response[i].shop_name;
                   var gcontent= `<div class="row mx-1">
                        <div class="col-12">
                            <h6 class="m-1 p-0" style="font-size: 14px;line-height: 23px;font-weight: bold;">`+data.response[i].shop_name+`</h6>
                            <button  id="`+data.response[i].id+`" class="btn btn-sm px-1" style="border: 2px solid #0d71d5;border-radius: 10px;color: #1b1e21" title="Click To Take This Service" onclick="addtocart(`+data.response[i].id+`)">Take Service From Here<i class="fa fa-arrow-right ml-1" aria-hidden="true"></i></button>
                        </div>
                    </div>`;
                   var gicn= 'http://icons.iconarchive.com/icons/graphicloads/polygon/32/shopping-cart-icon.png';
                   var GLatLng = new google.maps.LatLng(glatval, glngval);
                   createMarker(GLatLng,gicn,gname,gcontent);
                   $('.near_venodr_list').append(`<div class="row px-1" style="cursor: pointer;" onclick="addtocart(`+data.response[i].id+`)">
                                                <div class="col-2 p-0 text-center">
                                                    <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-lg m-0">
                                                        <i class="flaticon-house"></i>
                                                    </div>
                                                </div>
                                                <div class="col-10 mt-1">
                                                    <h6 class="mb-1 p-0 pr-2" style="font-size: 14px;line-height: 19px;font-weight: bold;">`+data.response[i].shop_name+`</h6>
                                                    <p class="m-0 pr-2" style="font-size: 13px;line-height: 15px;">`+data.response[i].address+`</p>
                                                </div>
                                            </div>`);
                   //For list
               }
           }
        }
    });
}
function addtocart(vendor_id){
   console.log(vendor_id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/addToCart',
        method: 'post',
        data: {
            vendor_id:vendor_id,
            subChildId:get_service(),
        },
        success: function(data){
            console.log(data)
            toastr.success('Service added in your cart <span style="font-size: 15px;">&#10084;&#65039;</span>');
            // $('#cartContShow').html('<div>'+data.response['countCart']+'</div>');
            $('#number-cart').html(data.response['countCart']);
            $('#vendorModal').modal('hide');
            $('.cartbtn_'+get_service()).html('<h6>Added</h6>');
            $('.service-details-cart').append(`<tr class="cart_item border-0">
                                        <td class="product-name py-2 border-0">
                                            <p style="font-size: 15px;color: #0c0c0c" class="mb-1">`+data.response['options'].subcategory_name+`</p>
                                            `+data.response['name']+`
                                            <strong class="product-quantity">× `+data.response['qty']+`</strong>
                                        </td>
                                        <td class="product-total border-0">
                                                    <span class="Price-amount">
                                                        <span class="Price-currencySymbol">৳</span>`+data.response['price']+`
                                                    </span>
                                        </td>
                                    </tr>`);
            $('.service-empty-cart').empty();
        }
    });

}


