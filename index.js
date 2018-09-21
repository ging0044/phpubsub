(function($) {

  function makeRequest(id) {
    return $.ajax(
      "/poll.php",
      {
        method: "GET",
        data: {
          id: id
        }
      }
    ).then(function(response) {
      appendMessages(response);

      makeRequest(response[response.length - 1].id);
    });
  }

  function appendMessages(messages) {
    messages.forEach(appendMessage);
  }

  function appendMessage(message) {
    const li = $("<li>")
      .text(message.text);
    $("#messages").append(li);
  }

  function sendMessage(text) {
    return $.ajax(
      "/message.php",
      {
        method: "POST",
        data: {
          text: text
        }
      }
    );
  }

  $(document).on("submit", "form", function(e) {
    const text = document.forms.message.text.value;
    document.forms.message.text.value = "";

    if (text) {
      sendMessage(text);
    }

    return false;
  });

  $(document).ready(function() {
    const id = $("li[data-id]").toArray().reduce(function(acc, i) {
      const currentId = parseInt(i.getAttribute("data-id"));
      if (currentId > acc) {
        acc = currentId;
      }
      return acc;
    }, 0);
    makeRequest(id);
  });

})(jQuery);

