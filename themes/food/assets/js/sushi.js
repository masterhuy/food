$(document).ready(function(){
    replaceImageInstagram();
    replaceIconNavTestimonial();
});

function replaceIconNavTestimonial(){
    let btnNext = '<svg width="48" height="52" viewBox="0 0 48 52" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.15992 24.1748L41.7839 24.1748L33.6623 15.3764C33.0047 14.664 33.0047 13.5148 33.6623 12.8024C34.3199 12.09 35.3855 12.09 36.0431 12.8024L47.0351 24.7104C47.6927 25.4228 47.6927 26.5772 47.0351 27.2896L36.0431 39.1976C35.3855 39.91 34.3199 39.91 33.6623 39.1976C33.0047 38.4852 33.0047 37.336 33.6623 36.6236L41.7839 27.82L2.15992 27.82C1.22872 27.82 0.479919 27.0088 0.479919 26C0.479919 24.9912 1.23832 24.1748 2.15992 24.1748Z" fill="white"/></svg>';
    let btnPrev = '<svg width="48" height="52" viewBox="0 0 48 52" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M45.8401 27.8252H6.21608L14.3377 36.6236C14.9953 37.336 14.9953 38.4852 14.3377 39.1976C13.6801 39.91 12.6145 39.91 11.9569 39.1976L0.96488 27.2896C0.30728 26.5772 0.30728 25.4228 0.96488 24.7104L11.9569 12.8024C12.6145 12.09 13.6801 12.09 14.3377 12.8024C14.9953 13.5148 14.9953 14.664 14.3377 15.3764L6.21608 24.18H45.8401C46.7713 24.18 47.5201 24.9912 47.5201 26C47.5201 27.0088 46.7617 27.8252 45.8401 27.8252Z" fill="white"/></svg>'
    $(".testimonial .owl-nav button").empty();
    $(".testimonial .owl-nav button.owl-next").html(btnNext);
    $(".testimonial .owl-nav button.owl-prev").html(btnPrev);
}

function replaceImageInstagram(){
    let row = $(".footer-5 .instagram .block-content .row");
    row.empty();
    let instagram = "";
    for(let i = 1; i <= 4; i++){
        instagram += `<div class="col-6 col-md-3"><a href="#"><img class="w-100" src="themes/food/assets/img/sushi/sushi-instagram-${i}.jpg"/></a></div>`;
    }
    row.html(instagram);
}