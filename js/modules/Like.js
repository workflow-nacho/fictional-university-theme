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
    if (currentLikeBox.data("exists") == "yes") {
      this.deleteLike(currentLikeBox);
    } else {
      this.createLike(currentLikeBox);
    }
  }

  createLike(currentLikeBox) {
    $.ajax({
      url: universityData.root_url + "/wp-json/university/v1/manageLike/",
      type: "POST",
      data: { professorID: currentLikeBox.data("professor") },
      success: (response) => {
        console.log(response);
      },
      error: (error) => {
        console.log(error);
      },
    });
  }

  deleteLike(currentLikeBox) {
    $.ajax({
      url: universityData.root_url + "/wp-json/university/v1/manageLike/",
      type: "DELETE",
      success: (response) => {
        console.log(response);
      },
      error: (error) => {
        console.log(error);
      },
    });
  }
}

export default Like;
