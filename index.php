<html>
  <head>
    <title>AJAX Quotes</title>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Tulpen+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@600&display=swap');

      
        /* CSS for web page */
        body {
          background-image: url('https://gcdnb.pbrd.co/images/if7OkM9CgsnP.jpg');
          background-blend-mode: lighten;
          background-position: bottom;
          background-size: cover;
        }
      
        h1, p {
          font-family: sans-serif;
          text-align: center;
          padding: 10pt;
        }

        div {
          text-align: center;
          position: absolute;
          left: 15%;
          height: 200pt;
          width: 70%;
          padding: 10pt;
        }

        /* CSS to hide the quote container initially and apply fade-in animation */
        #quoteContainer {
            display: none;
            text-shadow: 4px 4px 4px #aaa;
            font-size: 30pt;
            position: center;
        }

        /* CSS for the fade-in animation */
        .fade-in {
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: .5; }
            to { opacity: 1; }
        }

    </style>
  </head>
  <body>
      <h1>AJAX Quotes</h1>
      <p>In this page, a random quote is generated every 5 seconds.
        <br>The behavior of the page is altered to run on page load instead of via click.
        <br>A fade in effect is applied to animate between quote, and
        <br>rotating array of google fonts was added to make the quotes appear unique.
        <br>Additionally, we added a text shadow to make the quotes appear to float above the page</p>
      <div id="quoteContainer">Quote goes here</div>
    <script>
      var counter = 0;
      function getRandomQuote(){

        var fonts = ["Qwitcher Grypen", "Tulpen One", "Shadows Into Light", "Caveat"];

        var xhr = new XMLHttpRequest();

        xhr.open('GET', 'random_quotes.php',true);
        
        xhr.onload = function(){
          //code on return of data goes here
          if(xhr.status >= 200 && xhr.status < 300){//good data returned, show it!
            // document.querySelector("#quoteContainer").innerText = xhr.responseText;

            var quoteContainer = document.querySelector("#quoteContainer");
            quoteContainer.innerText = xhr.responseText;
            quoteContainer.style.display = "block";

            quoteContainer.style.fontFamily = fonts[counter];
            counter++;

            if(counter >= fonts.length){
              
            }
            
            quoteContainer.classList.add("fade-in");

            setTimeout(function(){
              quoteContainer.classList.remove("fade-in");
            },1000);
                                                                    
          }else{//something went wrong, give feedback
            document.querySelector("#quoteContainer").innerText = "Failed to fetch quote";
          }
          
          
        };
        
        xhr.onerror = function(){
          //code on error goes here
                  alert("Uh oh!");
        };

        //sends data to server
        xhr.send();
      }

      function displayRandomQuote(){
        //initial page load
        getRandomQuote();

        //run again at intervals
        setInterval(getRandomQuote,5000);
      }

      //run page load
      displayRandomQuote();
    </script>
  </body>
</html>
