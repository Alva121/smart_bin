<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <style type="text/css">
        body
        {
            font-family: Arial;
            font-size: 10pt;
        }
    </style>
    <script src="mqtt.js" type="text/javascript"></script>
  <script src="config.js" type="text/javascript"></script>
    <script src="w3.js" type="text/javascript"></script>
</head>
<body>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCccic5O5iz_A-tZ4IhkCKe_LZHp0rHH0E"></script>
<script type="text/javascript">
     var map;
     var mapOptions;
          var marker;
          var m1;
          var m2;
          var m3;
          var m=new Array(100);
          var markers=<?php


$conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');


$location=mysqli_query($conn,"select * from bin_location");
$a=array();

while($row1= mysqli_fetch_assoc($location))
{
  array_push($a, $row1);
}
echo json_encode($a);
?>;
    // var markers = [
    // {
    //     "title": 'Canara Engineering College, Benjana Padavu, Karnataka',
    //     "lat": '   12.8987552',
    //     "lng": '74.9822813',
    //     "description": 'Canara Engineering College, Benjana Padavu, Karnataka'

    // },
    // {
    //     "title": 'Nehru nagar',
    //     "lat": '12.7761283',
    //     "lng": '75.176463',
    //     "description": 'Nehru nagar,puttur'
    // },
    // {
    //     "title": 'Bolwar',
    //     "lat": ' 12.7680622',
    //     "lng": '75.1897967',
    //     "description": 'Bolwar,puttur'
    // },
    // {
    //     "title": 'Mura',
    //     "lat": '12.781157',
    //     "lng": '75.1718152',
    //     "description": 'Mura,puttur'
    // },
    // {
    //     "title": 'Mangal store',
    //     "lat": '12.7782817',
    //     "lng": '75.1785579',
    //     "description": 'Mangal store,puttur.'
    // }
    // ];


    window.onload = function () {
         mapOptions = {
            center: new google.maps.LatLng(<?php echo $_GET['lat'];?>,<?php echo $_GET['lng'];?>),
            zoom: 18,
            mapTypeId: google.maps.MapTypeId.ROADMAP

        };
           map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        MQTTconnect();
    }
    function LoadMap(payload) {


        //Create and open InfoWindow.
        var infoWindow = new google.maps.InfoWindow();
var l;

//console.log(payload.substring(10,12));


var bin=JSON.parse(payload);
switch(Number(bin.status))
{

case 1:
 l={text: "Garbage empty", color: "green",fontSize: "20px"};
break;
case 2:
 l={text: "Garbage Medium", color: "orange",fontSize: "20px"};
break;
case 3:
 l={text: "Garbage Full", color: "red",fontSize: "20px"};



}
// if(payload.search("Empty")!=-1)
// {
// console.log("empty");
//  l={text: "Garbage empty", color: "green",fontSize: "20px"};
// }else if(payload.search("Medium")!=-1)
// {
//  l={text: "Garbage Medium", color: "orange",fontSize: "20px"};
// }else if(payload.search("FULL")!=-1)
// {
//  l={text: "Garbage FULL", color: "red",fontSize: "20px"};
// }
var icon = {
    url: 'b.png',
    origin: new google.maps.Point(0, 0),
    labelOrigin: new google.maps.Point(20,0)
};
var myLatlng;
var data ;





// for(var i=0;i<markers.length;i++)

// {
var i=Number(bin.id);
console.log(markers[i-1]);
if(m[i]==null)
{
   data = markers[i-1];

myLatlng = new google.maps.LatLng(data.lat, data.lng);

m[i] = new google.maps.Marker({
                position: myLatlng,
                map: map,
                label:l,
                icon: icon,
                title: data.status
            });

}else
{
   var label =m[i].getLabel();
    label.color=l.color;
    label.text=l.text;
   m[i].setLabel(label);
}
// }


// if(payload.substring(0,3).search("BOL")!=-1)
// {
//    data = markers[2];

//             myLatlng = new google.maps.LatLng(data.lat, data.lng);
//   try{
//          if(m1==null)
//          {
// m1 = new google.maps.Marker({
//                 position: myLatlng,
//                 map: map,
//                 label:l,
//                 icon: icon,
//                 title: data.title
//             });

//   console.log("Create");
//          }else
//          {

//     var label = m1.getLabel();
//     label.color=l.color;
//     label.text=l.text;
//     m1.setLabel(label);

//          }
//          }catch(e){}

// }else if(payload.substring(0,3).search("NAG")!=-1)
// {
//    data = markers[1];

//             myLatlng = new google.maps.LatLng(data.lat, data.lng);

// if(m2==null)
// {
// m2 = new google.maps.Marker({
//                 position: myLatlng,
//                 map: map,
//                 label:l,
//                 icon: icon,
//                 title: data.title
//             });

// }else
// {
//    var label = m2.getLabel();
//     label.color=l.color;
//     label.text=l.text;
//     m2.setLabel(label);
// }
// }else if(payload.substring(0,3).search("BNR")!=-1)
// {
//    data = markers[0];

//             myLatlng = new google.maps.LatLng(data.lat, data.lng);
//   try{
//             marker.setMap(null);
//          }catch(e){}
// marker = new google.maps.Marker({
//                 position: myLatlng,
//                 map: map,
//                 label:l,
//                 icon: icon,
//                 title: data.title
//             });
// }





       for (var i = 0; i < markers.length; i++) {





            //Attach click event to the marker.
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + "hat" + "</div>");
                    infoWindow.open(map, marker);
                });
            })(m[i], data[i]);
       }
    }




  var mqtt;
    var reconnectTimeout = 5000;
    var host,port;

    function MQTTconnect() {

       host='broker.mqttdashboard.com';
    port=8000;
  if (typeof path == "undefined") {
    path = '/mqtt';
  }
  mqtt = new Paho.MQTT.Client(host,parseInt(port),
      path,
      "web_" + parseInt(Math.random() * 100, 10)
  );
        var options = {
            timeout: 60,
            useSSL: false,
            cleanSession:true,
            onSuccess: onConnect,
            onFailure: function (message) {

            }
        };

        mqtt.onConnectionLost = onConnectionLost;
        mqtt.onMessageArrived = onMessageArrived;

        if (username != null) {
            options.userName = username;
            options.password = password;
        }
       mqtt.connect(options);
  try{
      //  mqtt.disconnect();
      }catch(e){}finally{

      }


    }

    function onConnect() {
       alert('Connected to ' + host + ':' + port + path);
        // Connection succeeded; subscribe to our topic
        mqtt.subscribe("slekin/test/bin", {qos: 0});

        rc=true;

    }

    function onConnectionLost(response) {

        setTimeout(MQTTconnect, reconnectTimeout);
        $('#status').html("connection lost: " + response.errorMessage + ". Reconnecting");

    };




    function onMessageArrived(message) {
         var topic = message.destinationName;
             var payload = message.payloadString;
       console.log(payload);
      try{
         LoadMap(payload);
      }catch(e){}
        //$('#ws').append('<li>' + topic + ' = ' + payload + '</li>');
        //  $('#ws1').append('<li>' + topic + ' = ' + payload + '</li>');

    }

     function onLogout()
     {

      mqtt.disconnect();

     }
    function onSend(a)
    {

      message = new Paho.MQTT.Message(a);
    message.destinationName = "sc-home";
    message.qos=0;
    mqtt.send(message);
    }
       // MQTTconnect();
</script>
<div id="dvMap" style="width: 100%; height: 100vh;margin:0px auto">
</div>
</body>


</html>
