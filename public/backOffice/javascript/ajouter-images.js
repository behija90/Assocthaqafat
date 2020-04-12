var $addImageLink = $('<div class="col-lg-4"> <button href="#" id="btn-add-image-element" class="btn btn-purple btn-labeled fa fa-plus" type="button">Ajouter photo</button></div>');
var $newLinkLiImage = $('<div class="col-lg-12"><li></li></div>').append($addImageLink);

$(document).ready(function () {

    // Get the ul that holds the collection of images
    var $collectionHolderImage = $('ul.add-images');

    // add a delete link to all of the existing image form li elements
    $collectionHolderImage.find('li').each(function () {
        addImageFormDeleteLink($(this));
    });

    // add the "add a image" anchor and li to the images ul
    $collectionHolderImage.append($newLinkLiImage);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolderImage.data('index', $collectionHolderImage.find(':input').length);

    $addImageLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new image form (see code block below)
        addImageForm($collectionHolderImage, $newLinkLiImage);
    });


});

function addImageForm($collectionHolderImage, $newLinkLiImage) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolderImage.data('prototype');

    // get the new index
    var index = $collectionHolderImage.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolderImage.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a image" link li
    var $newFormLiImage = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLiImage.find('div').last().append('<a href="#" class="remove-item-collection text-danger text-bold">x</a>');

    $newLinkLiImage.before($newFormLiImage);

    // handle the removal, just for this example
    $('.remove-item-collection').click(function (e) {
        e.preventDefault();

        $(this).parentsUntil('li').fadeOut(function () {
            $(this).parents('li').remove();
        });

        return false;
    });

    // add a delete link to the new form
    //addImageFormDeleteLink($newFormLiImage);
}

function addImageFormDeleteLink($imageFormLi) {
    var $removeFormA = $('<a href="#" class="remove-item-collection text-danger text-bold">x</a>');
    $imageFormLi.find('div').last().append($removeFormA);

    $removeFormA.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        $imageFormLi.fadeOut(function () {
            // remove the li for the image form
            $imageFormLi.remove();
        });

    });
}
