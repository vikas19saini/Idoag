<style type="text/css">

    /*===================== common for all places color*/
@if($institution->color1)

    .institutionsign_info .institutionsign_right, .institutionicon_list .follow_txt, .notice_feed_list h3 img, .institutionsign_info .institutionsign_left h3 img, .postanewoffer_info h3 img, .institutionsign_infomiddle_right .institutionsign_listcont h3 img, .institutionsign_gallery .institutionoffer_img .note_img2 img, .brandoffer_contleft .note_img2 img, .postsomething_statistics_info .postsomething_info ul li img,   .photowidget_cont .photowidget_continner .photowidget_continnercont .readmore_btn img, .submit_btn, .institution_poast_info .institution_setting_txt ul li .val_val img, .sendyourownnote_info input[type="submit"], .seealloffers_btn, .available_txt ul li, .brandicon_list .follow_txt {
        background-color: {{$institution->color1}} !important;
    }

    .institution_poast_info .editsettings_btn a, .institution_notesfeedback_txt ul li .notice_feed_listinnercont a, .nav_info2 h4, .nav_info2 ul li a:hover, .nav_info2 ul li.active a, .postsomething_statistics_info .statistics_info .viewall_btn, .postanewoffer_info h3, .photowidget_cont h6, .postsomething_statistics_info .postsomething_info ul li p, .notice_feed_listinnercont h6, .institutionoffer_cont h6 {
        color: {{$institution->color1}} !important;
    }

    .institutionsign_info .institutionsign_right .new_txt {
        border-top: 100px solid {{$institution->color1}} !important;
    }

@else

    .institutionsign_info .institutionsign_right, .institutionicon_list .follow_txt, .notice_feed_list h3 img, .institutionsign_info .institutionsign_left h3 img, .postanewoffer_info h3 img, .institutionsign_infomiddle_right .institutionsign_listcont h3 img, .institutionsign_gallery .institutionoffer_img .note_img2 img, .brandoffer_contleft .note_img2 img, .postsomething_statistics_info .postsomething_info ul li img, .photowidget_cont .photowidget_continner .photowidget_continnercont .readmore_btn img, .submit_btn, .institution_poast_info .institution_setting_txt ul li .val_val img, .sendyourownnote_info input[type="submit"], .seealloffers_btn, .available_txt ul li, .brandicon_list .follow_txt  {
        background-color: #c40606 !important;
    }

    .institution_poast_info .editsettings_btn a, .institution_notesfeedback_txt ul li .notice_feed_listinnercont a, .nav_info2 h4, .nav_info2 ul li a:hover, .nav_info2 ul li.active a, .postsomething_statistics_info .statistics_info .viewall_btn, .postanewoffer_info h3, .photowidget_cont h6, .postsomething_statistics_info .postsomething_info ul li p, .notice_feed_listinnercont h6, .institutionoffer_cont h6 {
        color: #c40606 !important;
    }

    .institutionsign_info .institutionsign_right .new_txt {
        border-top: 100px solid #c40606 !important;
    }

@endif
</style>