<?php if (!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])) {
    header("Location: /login");
} ?>

<?php define("tabname", "Talk"); ?>
<?php include_once("../base/header.php"); ?>
    <?php if($uusername == "Madison"){
        die("Failed to Load Chat<br>Reason: You have been temprorarily banned from chat. <br>Content Type: harassment <br> Message Content: OSCAR AND EMERSON IS UGLY<br>Chat will be granted on December 9th, 2023");
    }
    
?>
<?php 

    $sid = getid($_GET["recipient"]);

?>


<div class="main" id="main">
  <h1>Chat with <?php echo htmlspecialchars($_GET["recipient"]) ?></h1>
  <h2 style="color: red;">Change of plans, chat will be migrated to the new system soon. </h2>
  <div id="chat-container" class="chat-box"></div>
  <form id="chat-form">
    <input type="text" id="message-input" placeholder="Type your message here" required>
    <button type="submit">Send</button>
  </form>
  <small>This chat is not moderated, so anything sent can and might be a scam message.<br>If you do not like the way a user is talking to you, please tell an admin.</small>
</div>

<script>

chatBox = document.querySelector(".chat-box");

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  
// Array of banned words or phrases
var bannedWords = ['rthrjtjrtjrhtrhtrtjr'];

// Function to check if the message contains any banned words
function containsBannedWords(message) {
  var lowerCaseMessage = message.toLowerCase();
  for (var i = 0; i < bannedWords.length; i++) {
    if (lowerCaseMessage.includes(bannedWords[i])) {
      return true;
    }
  }
  return false;
}

function displayMessage(message, username, isSent) {
  var chatContainer = document.getElementById('chat-container');
  var messageContainer = document.createElement('div');
  messageContainer.classList.add('message');

  if (isSent) {
    messageContainer.classList.add('sent-message');
  } else {
    messageContainer.classList.add('received-message');
  }

  var mSg = document.createElement('p');

  // Check if the message contains a link
  var linkRegex = /(https?:\/\/[^\s]+)/g;
  var parts = message.split(linkRegex);

  if (parts.length > 1) {
    for (var i = 0; i < parts.length; i++) {
      if (linkRegex.test(parts[i])) {
        if (isImageLink(parts[i])) {
          var pfp = document.createElement('img');
          var user = document.createElement('div');
          var usernameT = document.createElement('p');
          var image = createImageElement(parts[i]);
          messageContainer.style.display = 'flex';
          messageContainer.style.flexDirection = 'row';
          messageContainer.style.marginTop = '15px';
          pfp.style.height = '50px';
          pfp.style.borderRadius = '50%';
          user.style.marginLeft = '15px';
          user.style.display = 'flex';
          user.style.flexDirection = 'column';
          user.style.justifyContent = 'space-between';
          usernameT.innerText = username;
          usernameT.style.padding = '0';
          usernameT.style.margin = '0';
          usernameT.style.fontWeight = 'bold';
          
          image.style.maxWidth = '50%';
          image.style.padding = '0';
          image.style.margin = '0';
      
          messageContainer.appendChild(pfp);
          messageContainer.appendChild(user);
          user.appendChild(usernameT);
          user.appendChild(image);

          // Set the 'data-username' attribute on the message container
          messageContainer.setAttribute('data-username', username);

        //   // Get the pfp source based on the username
        //   var request = new XMLHttpRequest();
        //   request.onreadystatechange = function() {
        //     if (request.readyState === 4 && request.status === 200) {
        //       var messageUsername = messageContainer.getAttribute('data-username');
        //       if (messageUsername === username) {
        //         pfp.src = request.responseText;
        //       }
        //     }
        //   };
        //   request.open('GET', 'get-pfp.php?username=' + encodeURIComponent(username), true);
        //   request.send();
        } else if (isVideoLink(parts[i])) {
          var pfp = document.createElement('img');
          var user = document.createElement('div');
          var usernameT = document.createElement('p');
          var video = createVideoElement(parts[i]);
          messageContainer.style.display = 'flex';
          messageContainer.style.flexDirection = 'row';
          messageContainer.style.marginTop = '15px';
          pfp.style.height = '50px';
          pfp.style.borderRadius = '50%';
          user.style.marginLeft = '15px';
          user.style.display = 'flex';
          user.style.flexDirection = 'column';
          user.style.justifyContent = 'space-between';
          usernameT.innerText = username;
          usernameT.style.padding = '0';
          usernameT.style.margin = '0';
          usernameT.style.fontWeight = 'bold';
          video.style.padding = '0';
          video.style.margin = '0';
          
          messageContainer.appendChild(pfp);
          messageContainer.appendChild(user);
          user.appendChild(usernameT);
          user.appendChild(video);

          // Set the 'data-username' attribute on the message container
          messageContainer.setAttribute('data-username1', username);

        //   // Get the pfp source based on the username
        //   var request = new XMLHttpRequest();
        //   request.onreadystatechange = function() {
        //     if (request.readyState === 4 && request.status === 200) {
        //       var messageUsername = messageContainer.getAttribute('data-username1');
        //       if (messageUsername === username) {
        //         pfp.src = request.responseText;
        //       }
        //     }
        //   };
        //   request.open('GET', '/api/getpfp.php?username=' + encodeURIComponent(username), true);
        //   request.send();
        } else {
          var link = createLinkElement(parts[i]);
          
          var pfp = document.createElement('img');
          var user = document.createElement('div');
          var usernameT = document.createElement('div');
          var messageT = document.createElement('div');
          messageContainer.style.display = 'flex';
          messageContainer.style.flexDirection = 'row';
        }
      } else if (parts[i] !== '') {
        var textNode = document.createTextNode(parts[i]);
        mSg.appendChild(textNode);
      }
    }
  } else {
    var pfp = document.createElement('img');
    var user = document.createElement('div');
    var usernameT = document.createElement('p');
    var messageT = document.createElement('p');
    messageContainer.style.display = 'flex';
    messageContainer.style.flexDirection = 'row';
    messageContainer.style.marginTop = '15px';
    
    pfp.style.height = '50px';
    pfp.style.borderRadius = '50%';
    user.style.marginLeft = '15px';
    user.style.display = 'flex';
    user.style.flexDirection = 'column';
    user.style.justifyContent = 'space-between';
    usernameT.innerText = username;
    usernameT.style.padding = '0';
    usernameT.style.margin = '0';
    usernameT.style.fontWeight = 'bold';
    messageT.innerText = message;
    messageT.style.padding = '0';
    messageT.style.margin = '0';
    
    messageContainer.appendChild(pfp);
    messageContainer.appendChild(user);
    user.appendChild(usernameT);
    user.appendChild(messageT);

    // Set the 'data-username' attribute on the message container
    messageContainer.setAttribute('data-username', username);
    
    // // Get the pfp source based on the username
    // var request = new XMLHttpRequest();
    // request.onreadystatechange = function() {
    // if (request.readyState === 4 && request.status === 200) {
    //   var messageUsername = messageContainer.getAttribute('data-username');
    //   if (messageUsername === username) {
    //     pfp.src = request.responseText;
    //   }
    // }
    // };
    // request.open('GET', '/api/getpfp.php?username=' + encodeURIComponent(username), true);
    // request.send();
    

  }

  chatContainer.appendChild(messageContainer);
    scrollToBottom()
}



// Function to check if a message contains a link
function isLink(message) {
  var linkRegex = /(https?:\/\/[^\s]+)/g;
  return linkRegex.test(message);
}

// Function to check if a link is an image link
function isImageLink(url) {
  var imageRegex = /\.(jpeg|jpg|gif|png)$/i;
  return imageRegex.test(url);
}

// Function to check if a link is a video link
function isVideoLink(url) {
  var videoRegex = /\.(mp4|mov|wmv|flv|avi)$/i;
  return videoRegex.test(url);
}

// Function to create an <a> element for the link
function createLinkElement(url) {
  var link = document.createElement('a');
  link.href = url;
  link.textContent = url;
  link.target = '_blank';
  return link;
}

// Function to create an <img> element for the image
function createImageElement(url) {
  var image = document.createElement('img');
  image.src = url;
  image.alt = 'Image';
  image.classList.add('embedded-image');
  
  // Adjust image size based on aspect ratio
  image.onload = function() {
    var aspectRatio = image.width / image.height;
    if (aspectRatio > 1) {
      image.style.maxWidth = '100%';
      image.style.height = 'auto';
    } else {
      image.style.maxWidth = '50%';
      image.style.height = 'auto';
    }
  };
  
  return image;
}

// Function to create a <video> element for the video
function createVideoElement(url) {
  var video = document.createElement('video');
  video.src = url;
  video.controls = true;
  video.classList.add('embedded-video');
  video.style.maxWidth = '100%';
  
  return video;
}

// Function to send a message
function sendMessage(event) {
  event.preventDefault();

  var messageInput = document.getElementById('message-input');
  var message = messageInput.value.trim();

  // Check if the message contains any banned words
  if (containsBannedWords(message)) {
    // Display an error message to the user
    displayErrorMessage('Your message contains inappropriate content.');
    return;
  }

  // Rest of your code to send the message
  var sender = '<?php echo $uusername; ?>';
  var recipient = '<?php echo $_GET["recipient"]; ?>';

  var data = new FormData();
  data.append('sender', sender);
  data.append('recipient', recipient);
  data.append('message', message);

  // Send the message to the server
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '/api/chat-endpoint.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.error) {
          // Error occurred, display error message to the user
          console.error(response.error);
        } else {
          // Message sent successfully
          displayMessage(message, sender, true);
        }
      } else {
        // Error occurred, display error message to the user
        console.error('Error sending message.');
      }
    }
  };
  xhr.send(data);

  // Clear the message input field
  messageInput.value = '';
}

// Function to display an error message in the chat container
function displayErrorMessage(errorMessage) {
  var chatContainer = document.getElementById('chat-container');
  var errorContainer = document.createElement('div');
  errorContainer.classList.add('error-message');
  errorContainer.textContent = errorMessage;
  chatContainer.appendChild(errorContainer);

  // Scroll to the error message
  errorContainer.scrollIntoView({ behavior: 'smooth', block: 'end' });
}

// Function to receive messages using AJAX
function receiveMessages() {
  var sender = '<?php echo $_GET["recipient"]; ?>';
  var recipient = '<?php echo $uusername; ?>';

  // Retrieve messages from the server
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '/api/chat-endpoint.php?sender=' + encodeURIComponent(sender) + '&recipient=' + encodeURIComponent(recipient), true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        console.log('Received response:', response);

        if (response.error) {
          // Error occurred, display error message to the user
          console.error(response.error);
        } else {
          var receivedMessages = response;

          console.log('Received Messages:', receivedMessages);

          // Clear the existing messages in the chat container
          var chatContainer = document.getElementById('chat-container');
          chatContainer.innerHTML = '';

          for (var i = 0; i < receivedMessages.length; i++) {
            var message = receivedMessages[i].message;
            var username = receivedMessages[i].sender;
            console.log('Displaying Message:', message);
            displayMessage(message, username, false);
          }
        }
      } else {
        // Error occurred, display error message to the user
        console.error('Error fetching messages. Status:', xhr.status);
      }
    }
  };
  xhr.send();
}

// Add event listener to the chat form
var chatForm = document.getElementById('chat-form');
chatForm.addEventListener('submit', sendMessage);

// Call receiveMessages() function at regular intervals
setInterval(receiveMessages, 01000);

</script>
</body>
</html>
