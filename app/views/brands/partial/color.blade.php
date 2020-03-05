<style type="text/css">

     @if($brand->color1)

    .brandsign_info .brandsign_right, .brandicon_list .follow_txt, .notice_feed_list h3 img, .brandsign_info .brandsign_left h3 img, .postanewoffer_info h3 img, .brandsign_infomiddle_right .brandsign_listcont h3 img, .brandsign_gallery .brandoffer_img .note_img2 img, .postsomething_statistics_info .postsomething_info ul li img, .note_img2 img, .photowidget_cont .photowidget_continner .photowidget_continnercont .readmore_btn img, .submit_btn, .brand_poast_info .brand_setting_txt ul li .val_val img, .sendyourownnote_info input[type="submit"], .seealloffers_btn, .available_txt ul li, .couponcode_txt a, .coupon_codetxt, .brandsign_listcont .note_img2 img {
        background-color: {{$brand->color1}} !important;
    }

    .brand_poast_info .editsettings_btn a, .brand_notesfeedback_txt ul li .notice_feed_listinnercont a, .nav_info2 h4, .nav_info2 h4 a, .dashboard_list h4 a, .dashboard_events h4 a, .nav_info2 ul li a:hover, .nav_info2 ul li.active a, .postsomething_statistics_info .statistics_info .viewall_btn, .postanewoffer_info h3, .photowidget_cont h6, .postsomething_statistics_info .postsomething_info ul li p, .notice_feed_listinnercont h6, .brandoffer_cont h6, .dashboard_events h4, .dashboard_outlet h4, .brandoffer_list h4 {
        color: {{$brand->color1}} !important;
    }

    .brandsign_info .brandsign_right .new_txt {
        border-top: 100px solid {{$brand->color1}} !important;
    }

    @else

    .brandsign_info .brandsign_right, .brandicon_list .follow_txt, .notice_feed_list h3 img, .brandsign_info .brandsign_left h3 img, .postanewoffer_info h3 img, .brandsign_infomiddle_right .brandsign_listcont h3 img, .brandsign_gallery .brandoffer_img .note_img2 img, .postsomething_statistics_info .postsomething_info ul li img, .note_img2 img, .photowidget_cont .photowidget_continner .photowidget_continnercont .readmore_btn img, .submit_btn, .brand_poast_info .brand_setting_txt ul li .val_val img, .sendyourownnote_info input[type="submit"], .seealloffers_btn, .available_txt ul li, .couponcode_txt a, .coupon_codetxt, .brandsign_listcont .note_img2 img {
        background-color: #c40606 !important;
    }

    .brand_poast_info .editsettings_btn a, .brand_notesfeedback_txt ul li .notice_feed_listinnercont a, .nav_info2 h4, .nav_info2 h4 a, .dashboard_list h4 a, .dashboard_events h4 a, .nav_info2 ul li a:hover, .nav_info2 ul li.active a, .postsomething_statistics_info .statistics_info .viewall_btn, .postanewoffer_info h3, .photowidget_cont h6, .postsomething_statistics_info .postsomething_info ul li p, .notice_feed_listinnercont h6, .brandoffer_cont h6, .dashboard_events h4, .dashboard_outlet h4, .brandoffer_list h4 {
        color: #c40606 !important;
    }

    .brandsign_info .brandsign_right .new_txt {
        border-top: 100px solid #c40606 !important;
    }

    @endif
</style>