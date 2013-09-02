<html xmlns="http://www.w3.org/1999/xhtml"
  xmlns:fb="https://www.facebook.com/2008/fbml">
  <head>
    <title>My Feed Dialog Page</title>
  </head>
  <body>
    <div id='fb-root'></div>
    <script src='http://connect.facebook.net/en_US/all.js'></script>
    <p><a id="myAnchor" onclick='postToFeed(); return false;'>Post to Feed</a></p>
    <p id='msg'></p>

    <script> 
      FB.init({appId: "575560985812134", status: true, cookie: true});

      function postToFeed() {

        // calling the API ...
        var obj = {
          method: 'feed',
          redirect_uri: 'http://collegecanvas.org',
          link: 'http://collegecanvas.org',
          picture: 'http://fbrell.com/f8.jpg',
          name: 'Facebook Dialogs',
          caption: 'Reference Documentation',
          description: 'Using Dialogs to interact with users.',
          display: 'iframe',
          access_token: '38ae548e4a71bc13f802c77f31643003'
        };

        function callback(response) {
          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
        }

        FB.ui(obj, callback);
      }
      
      $('#myAnchor').click();
    
    </script>
  </body>
</html>