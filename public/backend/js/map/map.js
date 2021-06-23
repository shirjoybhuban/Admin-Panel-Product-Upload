var map;
var myLatLng;

// $(document).ready(function() {
//     //geoLocationInit();
// });
function geoLocationInit() {

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
    console.log(latval)
    myLatLng = new google.maps.LatLng(latval, lngval);

    createMap(myLatLng);
    searchVendors(latval,lngval);

}

function fail() {
    alert("Please Allow Location Access To Take Service");
}
//Create Map
function createMap(myLatLng) {
    map = new google.maps.Map(document.getElementById('shop_map'), {
        center: myLatLng,
        zoom: 13,
    });
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: 'https://icons.iconarchive.com/icons/icons-land/vista-map-markers/64/Map-Marker-Marker-Inside-Pink-icon.png',
        title: "Current Location"
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
        url: '/admin/get/all/shops/in/map',
        method: 'post',
        data: {
            lat:lat,
            lng:lng,
            // service_id:get_service(),
        },
        success: function(data){
            //console.log(data);
            if (data.response.length==0){
            }else{
                var i;

                for(i=0;i<data.response.length;i++){
                    var glatval=data.response[i].latitude;
                    var glngval=data.response[i].longitude;
                    var gname=data.response[i].name;
                    var gaddress=data.response[i].address;
                    var url = window.location.origin+'/shop/'+data.response[i].slug;
                    //console.log(url)
                    var gcontent= `<div class="row mx-1">
                            <div class="col-md-12">
                                <h6 class="m-1 p-0" style="font-size: 14px;line-height: 23px;font-weight: bold;">Name: `+data.response[i].name+`</h6>
                                <p class="m-1 p-0" style="font-size: 14px;">Area: `+data.response[i].area+`</p>
                                <p class="m-1 p-0" style="font-size: 14px;">City: `+data.response[i].city+`</p>
                                <p class="m-1 p-0" style="font-size: 14px;">Address: `+data.response[i].address+`</p>
                                <a class="btn btn-primary w-100" target="_blank" href="${url}" style="font-size: 14px;">Go to shop </a>
                               
                            </div>
                        </div>`;

                    var gicn= window.location.origin+'/backend/dist/img/shop-marker.png'
                    var GLatLng = new google.maps.LatLng(glatval, glngval);
                    createMarker(GLatLng,gicn,gname,gcontent);
                     //console.log(GLatLng);
                }
            }
        }
    });
}

function initialize() {
    // Creating map object
    var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 12,
        center: new google.maps.LatLng(28.47399, 77.026489),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    // creates a draggable marker to the given coords
    var vMarker = new google.maps.Marker({
        position: new google.maps.LatLng(28.47399, 77.026489),
        draggable: true
    });
    // adds a listener to the marker
    // gets the coords when drag event ends
    // then updates the input with the new coords
    google.maps.event.addListener(vMarker, 'dragend', function (evt) {
        $("#txtLat").val(evt.latLng.lat().toFixed(6));
        $("#txtLng").val(evt.latLng.lng().toFixed(6));
        map.panTo(evt.latLng);
    });
    // centers the map on markers coords
    map.setCenter(vMarker.position);
    // adds the marker on the map
    vMarker.setMap(map);
}
