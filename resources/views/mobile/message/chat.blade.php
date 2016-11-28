<!DOCTYPE html>
<html ng-app="demo">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="address=no">
    <title></title>


    <link rel="stylesheet" type="text/css" href="{{ _asset('wapstyle/rongcloud/widget/css/conversation.css') }}"/>

    <script>
      // window.WEB_XHR_POLLING = true;
    </script>
    <style>
      .kefubtn{
        position: fixed;
        left: 0px;
        bottom: 0px;
        right: 0px;
        text-align: center;
        height: 50px;
        line-height: 50px;
        background-color: #0099ff;
        color: white;
        font-size: 20px;
      }
    </style>
  </head>
  <body ng-controller="main">
    <div class="kefubtn" ng-click="kefu()">打开客服>></div>
    <div>
      <rong-widget></rong-widget>
    </div>
  </body>
  <!-- <script src="http://www.sobot.com/chat/h5/h5.min.js?sysNum=e5c6265f4a2c4ea4bc82ededa46f4c05" id="zhichiload" ></script> -->
  <script src="{{ _asset('wapstyle/rongcloud/lib/angular.js') }}"></script>
  <script src="{{ _asset('wapstyle/rongcloud/widget/main.js') }}"></script>
  <!-- <script src="../lib/main.js"></script> -->

  <script src="{{ _asset('wapstyle/rongcloud/index.js') }}"></script>
  
  <script>
  </script>

</html>