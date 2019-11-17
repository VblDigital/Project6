//For images
var $collectionImageHolder;

var $addImageButton = $('<button type="button" class="add_image">Ajouter une nouvelle image</button>');
var $newLinkImage = $('<p></p>').append($addImageButton);

jQuery(document).ready(function() {
    $collectionImageHolder = $('div.images');
    $collectionImageHolder.append($newLinkImage);
    $collectionImageHolder.data('index', $collectionImageHolder.find(':input').length);

    $addImageButton.on('click', function(e) {
        addImageForm($collectionImageHolder, $newLinkImage);
    });
});

//For videos
var $collectionVideoHolder;

var $addVideoButton = $('<button type="button" class="add_video_link">Ajouter un lien vers une vidéo</button>');
var $newLinkVideo = $('<p></p>').append($addVideoButton);

jQuery(document).ready(function() {
    $collectionVideoHolder = $('div.videos');
    $collectionVideoHolder.append($newLinkVideo);
    $collectionVideoHolder.data('index', $collectionVideoHolder.find(':input').length);

    $addImageButton.on('click', function(e) {
        addVideoForm($collectionVideoHolder, $newLinkVideo);
    });
});