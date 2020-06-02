var originalIsOpen = false;
var host = window.location.origin;
$(function(){
    triggerSelected();

    $('.clip-modal-open').on("click", function () {
        let articleId = $(this).data('id');
        $("#folder-selection-form #article-id").val( articleId );
        $("#del-article-form #del-article-id").val( articleId );

        let folderId = $(this).data('folder-id');
        if(folderId !== ""){
            $("#folder-selection-form #old-folder-id").val( folderId );
            $("#del-article-form #del-folder-id").val( folderId );
            $('#del-article-btn').show();            
        }else{
            $("#folder-selection-form #old-folder-id").val('');
            $("#del-article-form #del-folder-id").val('');            
            $('#del-article-btn').hide();            
        }

        let selectElm = $("#folder-selection-form #folder-id");
        setSelectElementValue(selectElm, folderId);

   });
    $('.star-modal-open').on("click", function () {
        let articleId = $(this).data('id');
        $("#star-rating-form #article-id").val( articleId );
        let stars = $(this).data('stars');        

        let selectElm = $("#star-rating-form #stars");
        setSelectElementValue(selectElm, stars);

   });

   $('#disp-original').on('click',function(){
       if(originalIsOpen == false){
           $('#original-article').show();
           originalIsOpen = true;
       }else{
           $('#original-article').hide();
           originalIsOpen = false;
       }
   });
   $('#del-article-btn').on('click',function(event){
        event.preventDefault();
        if(!confirm('本当にこのクリップ記事をフォルダから削除しますか？')){
            return;
        }
        $('#del-article-form').submit();
   });



    if(typeof idForUrl !== "undefined"){
        loadUrlContent(idForUrl);
    }   

});

function loadUrlContent(idForUrl)
{
    let routeUrl = host + '/api/external/show/' + idForUrl;

    $.get(routeUrl)
    .done(function(data){
        // alert(data.readingLength);
        setReadingLength(data.readingLength);
        purifyAndPlaceOriginalArticle(data.originalPage);
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        $('#original-article').html("エラーが発生しました。詳細：" + jqXHR.responseText);
    })
    .always(function(){
        $('#original-card').show();
    });
}

function setReadingLength(length)
{
    if(length === null){
        var message = '計測不能';
    }else{
        var message = `${length.toFixed(1)} 分`;
    }

    $('#readingLength').text(message);
}

function purifyAndPlaceOriginalArticle(externalHTML)
{
    var cleanHTML = sanitize(externalHTML);
   
    $('#original-article').html(cleanHTML);
}

function sanitize(externalHTML)
{
    return DOMPurify.sanitize(externalHTML, { SAFE_FOR_JQUERY: true });;
}

function setSelectElementValue(selectElm, value)
{
    selectElm.find('option').each(function(){
        if($(this).val() == value){
            selectElm.attr('selected','selected');
            $(this).prop('selected', true);
        }else{
            selectElm.removeAttr('selected');
        }
    });    
}

function triggerSelected()
{
    $('select').find('option[selected]').each(function(){
        $(this).prop('selected', true);
    });
}
