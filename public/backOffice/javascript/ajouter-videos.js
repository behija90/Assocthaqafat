var $addVideoLink = $('<div class="col-lg-4"> <button href="#" id="btn-add-video-element" class="btn btn-purple btn-labeled fa fa-plus" type="button">Ajouter video</button></div>');
var $newLinkLiVideo = $('<div class="col-lg-12"><li></li></div>').append($addVideoLink);

$(document).ready(function () {

    // Get the ul that holds the collection of videos
    var $collectionHolderVideo = $('ul.add-videos');

    // add a delete link to all of the existing video form li elements
    $collectionHolderVideo.find('li').each(function () {
        addVideoFormDeleteLink($(this));
    });

    // add the "add a video" anchor and li to the videos ul
    $collectionHolderVideo.append($newLinkLiVideo);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolderVideo.data('index', $collectionHolderVideo.find(':input').length);

    $addVideoLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new video form (see code block below)
        addVideoForm($collectionHolderVideo, $newLinkLiVideo);
    });


});

function addVideoForm($collectionHolderVideo, $newLinkLiVideo) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolderVideo.data('prototype');

    // get the new index
    var index = $collectionHolderVideo.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolderVideo.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a video" link li
    var $newFormLiVideo = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLiVideo.find('div').last().append('<a href="#" class="remove-item-collection text-danger text-bold">x</a>');

    $newLinkLiVideo.before($newFormLiVideo);

    // handle the removal, just for this example
    $('.remove-item-collection').click(function (e) {
        e.preventDefault();

        $(this).parentsUntil('li').fadeOut(function () {
            $(this).parents('li').remove();
        });

        return false;
    });

    // add a delete link to the new form
    //addVideoFormDeleteLink($newFormLiVideo);
}

function addVideoFormDeleteLink($videoFormLi) {
    var $removeFormA = $('<a href="#" class="remove-item-collection text-danger text-bold">x</a>');
    $videoFormLi.find('div').last().append($removeFormA);

    $removeFormA.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        $videoFormLi.fadeOut(function () {
            // remove the li for the video form
            $videoFormLi.remove();
        });

    });
}
