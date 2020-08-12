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
    var currentLikeBox = $(e.target).closest("like-box");
    if (currentLikeBox.data("exists") == "yes") {
      this.deleteLike();
    } else {
      this.createLike();
    }
  }

  createLike() {
    alert("create like");
  }

  deleteLike() {
    alert("delete like");
  }
}

export default Like;
