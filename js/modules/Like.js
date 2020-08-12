import $ from "jquery";

class Like {
  constructor() {
    this.events();
  }

  events() {
    $(".like-box").on("click", this.ourClickDispatcher.bind(this));
  }

  // Methods
  ourClickDispatcher(e) {
    // Find the ancestor that matches with like-box element
    var currentLikeBox = $(e.target).closest(".like-box");
    if (currentLikeBox.attr("data-exists") == "yes") {
      this.deleteLike(currentLikeBox);
    } else {
      this.createLike(currentLikeBox);
    }
  }

  createLike(currentLikeBox) {
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", universityData.nonce);
      },
      url: universityData.root_url + "/wp-json/university/v1/manageLike/",
      type: "POST",
      data: { professorID: currentLikeBox.data("professor") },
      success: (response) => {
        currentLikeBox.attr("data-exists", "yes");
        var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
        likeCount++;
        currentLikeBox.find(".like-count").html(likeCount);
        currentLikeBox.attr("data-like", response); // Get the post id after creating a new like post
        console.log(response);
      },
      error: (error) => {
        console.log(error);
      },
    });
  }

  deleteLike(currentLikeBox) {
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", universityData.nonce);
      },
      url: universityData.root_url + "/wp-json/university/v1/manageLike/",
      data: { like: currentLikeBox.attr("data-like") }, // Get the current like post id
      type: "DELETE",
      success: (response) => {
        currentLikeBox.attr("data-exists", "no");
        var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
        likeCount--;
        currentLikeBox.find(".like-count").html(likeCount);
        currentLikeBox.attr("data-like", "");
        console.log(response);
      },
      error: (error) => {
        console.log(error);
      },
    });
  }
}

export default Like;
