var $addFileLink = $('<div class="col-lg-4"> <button href="#" id="btn-add-file-element" class="btn btn-purple btn-labeled fa fa-plus" type="button">Ajouter fichier</button></div>');
var $newLinkLi = $('<div class="col-lg-12"><li></li></div>').append($addFileLink);

$(document).ready(function () {

    // Get the ul that holds the collection of files
    var $collectionHolder = $('ul.add-files');

    // add a delete link to all of the existing file form li elements
    $collectionHolder.find('li').each(function () {
        addFileFormDeleteLink($(this));
    });

    // add the "add a file" anchor and li to the files ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addFileLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new file form (see code block below)
        addFileForm($collectionHolder, $newLinkLi);
    });


});

function addFileForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a file" link li
    var $newFormLi = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.find('div').last().append('<a href="#" class="remove-item-collection text-danger text-bold">x</a>');

    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-item-collection').click(function (e) {
        e.preventDefault();

        $(this).parentsUntil('li').fadeOut(function () {
            $(this).parents('li').remove();
        });

        return false;
    });

    // add a delete link to the new form
    //addFileFormDeleteLink($newFormLi);
}

function addFileFormDeleteLink($fileFormLi) {
    var $removeFormA = $('<a href="#" class="remove-item-collection text-danger text-bold">x</a>');
    $fileFormLi.find('div').last().append($removeFormA);

    $removeFormA.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        $fileFormLi.fadeOut(function () {
            // remove the li for the file form
            $fileFormLi.remove();
        });

    });
}
