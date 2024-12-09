const urlField = document.querySelector(".field input"),
    previewArea = document.querySelector(".preview-area"),
    imgTag = previewArea.querySelector(".thumbnail"),
    hiddenInput = document.querySelector(".hidden-input");

urlField.onkeyup = () => {
    let imgUrl = urlField.value; //getting user entered value
    previewArea.classList.add("active");

    //https://www.youtube.com/watch?v=lqwdD2ivIbM example of video url ---- lqwdD2ivIbM this is a video id and its unique

    if (imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1) { //if entered value is yt video url
        let vidId = imgUrl.split("v=")[1].substring(0, 11); //splitting youtube video url from v= so we can get only video id
        let ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`; //passing entered url video id inside to thumbnail url
        imgTag.src = ytThumbUrl; //passing yt thumb url inside img
    } else if (imgUrl.indexOf("https://youtu.be/") != -1) { //if video url is looking like this
        let vidId = imgUrl.split("be/")[1].substring(0, 11); //splitting youtube video url from be/ so we can get only video id
        let ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`; //passing entered url video id inside to thumbnail url
        imgTag.src = ytThumbUrl; //passing yt thumb url inside img
    } else if (imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)) { //if entered value is other image file url
        imgTag.src = imgUrl; //passing user entered url inside image src 
    } else {
        imgTag.src = "";
        previewArea.classList.remove("active");
    }
    hiddenInput.value = imgTag.src; //passing img src to hidden input value;   
}