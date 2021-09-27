$( "#drawerButton, #closeIcon" ).on( "click", function() {
    $( "#drawer" ).toggleClass( "closeDrawer", 500 );
});


const showCart = (data)=>{
    let item ="";
    for (let x in data) {
        item += `<li>
                        <img src="${data[x].product_img}" alt="${data[x].product_name}">
                        <div class="mr-3">
                                <h2>${data[x].product_name}</h2>
                                <p>৳ ${data[x].product_price} x ${data[x].product_qty} qty</p>
                        </div>
                        <span>৳ ${data[x].product_price * data[x].product_qty}</span>
                    </li>`
    }
    $('#cartItems').html(item);
}
const handleAddToCart = ()=>{
    event.preventDefault();

    const e     = event.currentTarget.parentNode.parentNode;
    const pdId  =  event.currentTarget.getAttribute("data-pd_id");
    const pdPrice  =  event.currentTarget.getAttribute("data-pd_price");
    const pdImg  =  event.currentTarget.getAttribute("data-pd_img");
    const pdName  =  event.currentTarget.getAttribute("data-pd_name");
    const pdNameBn  =  event.currentTarget.getAttribute("data-pd_name_bn");
    const pdQty = 1;

    const qtyBtn = `<span class="qtyBtn" data-pd_id="${pdId}" data-pd_price="${pdPrice}" data-pd_img="${pdImg}" data-pd_name="${pdName}" data-pd_name_bn="${pdNameBn}">
                        <span class="decrease" onClick="decreaseQty()"><i class="ion-minus-round"></i></span>
                        <span class="qty">${pdQty}</span>
                        <span class="increase" onClick="increaseQty()"><i class="ion-plus-round"></i></span>
                    </span>`;
    e.innerHTML = qtyBtn;
    $('#cartTotalItem, #cartTotalItem2').text(parseInt($('#cartTotalItem').text()) + 1);
    $('#cartTotalAmount, #cartTotalAmount2').text(parseInt($('#cartTotalAmount').text()) + parseInt(pdPrice));
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: "set_session",
        data: {_token : $('meta[name="csrf-token"]').attr('content'), pdId:pdId, pdQty:pdQty, pdPrice:pdPrice, pdImg:pdImg, pdName:pdName, pdNameBn:pdNameBn},
        success:function(finaldata){             
            const rslt = JSON.parse(finaldata);
            showCart(rslt.data);
            if(rslt.result !== 'success'){
                const orderBtn = `<h6 class="mt-20"><a href="#" data-pd_price="${pdPrice}" data-pd_id="${pdId}" data-pd_img="${pdImg}" data-pd_name="${pdName}" data-pd_name_bn="${pdNameBn}" onClick="handleAddToCart()" class="btn-brdr-primary plr-25"><b>Order Now</b></a></h6>`;
                e.innerHTML=orderBtn;
                alert("fail to add cart. something went wrong");
            }
        }
    });
    return false;
}

const increaseQty = ()=>{
    event.preventDefault();
    const getPrev = event.currentTarget.previousElementSibling;
    const pdQty = parseInt(getPrev.innerText)+1;
    const pdId =  event.currentTarget.parentNode.getAttribute("data-pd_id");
    const pdPrice =  event.currentTarget.parentNode.getAttribute("data-pd_price");

    const pdImg  =  event.currentTarget.getAttribute("data-pd_img");
    const pdName  =  event.currentTarget.getAttribute("data-pd_name");
    const pdNameBn  =  event.currentTarget.getAttribute("data-pd_name_bn");

    getPrev.innerHTML=pdQty;
    $('#cartTotalAmount, #cartTotalAmount2').text(parseInt($('#cartTotalAmount').text()) + parseInt(pdPrice));
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "set_session",
        data: {_token : $('meta[name="csrf-token"]').attr('content'), pdId:pdId, pdQty:pdQty, pdPrice:pdPrice, pdImg:pdImg, pdName:pdName, pdNameBn:pdNameBn},
        success:function(finaldata){
            const rslt = JSON.parse(finaldata);
            showCart(rslt.data);
            if(rslt.result !== 'success'){
                getPrev.innerHTML = getPrev.innerText;
                alert("Fail to add cart. something went wrong");
            }
        }
    });
    return false;
}

const decreaseQty = ()=>{
    event.preventDefault();
    const getNext = event.currentTarget.nextElementSibling;
    const pdQty = parseInt(getNext.innerText)-1;
    const pdId =  event.currentTarget.parentNode.getAttribute("data-pd_id");
    const pdPrice =  event.currentTarget.parentNode.getAttribute("data-pd_price");

    const pdImg  =  event.currentTarget.getAttribute("data-pd_img");
    const pdName  =  event.currentTarget.getAttribute("data-pd_name");
    const pdNameBn  =  event.currentTarget.getAttribute("data-pd_name_bn");

    $('#cartTotalAmount, #cartTotalAmount2').text(parseInt($('#cartTotalAmount').text()) - parseInt(pdPrice));

    const e = event.currentTarget.parentNode.parentNode;
    if(pdQty > 0){
        getNext.innerHTML=pdQty;
    }else{
        const orderBtn = `<h6 class="mt-20"><a href="#" data-pd_id="${pdId}" onClick="handleAddToCart()" data-pd_price="${pdPrice}" data-pd_img="${pdImg}" data-pd_name="${pdName}" data-pd_name_bn="${pdNameBn}" class="btn-brdr-primary plr-25"><b>Order Now</b></a></h6>`;
        e.innerHTML=orderBtn;
        $('#cartTotalItem, #cartTotalItem2').text(parseInt($('#cartTotalItem').text()) - 1);
    }

    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: "set_session",
        data: {_token : $('meta[name="csrf-token"]').attr('content'), pdId:pdId, pdQty:pdQty, pdPrice:pdPrice, pdImg:pdImg, pdName:pdName, pdNameBn:pdNameBn},
        success:function(finaldata){
            const rslt = JSON.parse(finaldata);
            showCart(rslt.data);
            if(rslt.result !== 'success'){
                if(pdQty <= 0){
                    const qtyBtn = `<span class="qtyBtn" data-pd_id="${pdId}" data-pd_price="${pdPrice}" data-pd_img="${pdImg}" data-pd_name="${pdName}" data-pd_name_bn="${pdNameBn}"> <span class="decrease" onClick="decreaseQty()"><i class="ion-minus-round"></i></span>
                                    <span class="qty">${pdQty}</span>
                                    <span class="increase" onClick="increaseQty()"><i class="ion-plus-round"></i></span>
                                </span>`;
                    e.innerHTML=qtyBtn;
                }else{
                    getNext.innerHTML = getNext.innerText;
                }
                
                alert("Fail to add cart. something went wrong");
            }
        }
    });
    return false;
}

$('#registerForm').submit((e)=>{
    e.preventDefault();
    $('.errorMsg').html("");
    $('#successMsg').html("");
    $('#loginSubmit').prop("disabled", true);
    $('#loader').html("");

    $.ajax({
        type:'post',
        url:"register/store",
        data: $('#registerForm').serialize(),
        beforeSend: function(){

            $('#loader').html('<div class="spinner-border spinner-border-sm text-light ml-2"></div>');
    
        },
        success: function(result){
            console.log(result);
            $('#registerSubmit').prop("disabled", false);
            $('#loader').html("");
            if(result.status == 'error'){
                $.each(result.error, function(key, val){
                    $('#'+key).html(val[0]);
                })
            }   
            if(result.status == 'success'){
                $('#registerForm')[0].reset();
                $('#successMsg').html(`<div class="alert alert-success">${result.msg}</div>`);
            }         
        }

    });
});

$('#loginForm').submit((e)=>{
    e.preventDefault();
    $('.errorMsg').html("");
    $('#successMsg').html("");
    $('#loginSubmit').prop("disabled", true);
    $('#loader').html("");
    $.ajax({
        type:'post',
        url:"login/getLogin",
        data: $('#loginForm').serialize(),
        beforeSend: function(){
            $('#loader').html('<span class="spinner-border spinner-border-sm text-light ml-2"></span>');
        },
        success: function(result){
            console.log(result);
            $('#loginSubmit').prop("disabled", false);
            $('#loader').html("");
            if(result.status == 'error'){
                $.each(result.error, function(key, val){
                    $('#'+key).html(val[0]);
                })
            }
            if(result.status == 'msg'){
                $('#successMsg').html(`<div class="alert alert-danger">${result.msg}</div>`);
            }  
            if(result.status == 'success'){
                window.location.href="/";

            }         
        }

    });
});

$('#forgotPasswordForm').submit((e)=>{
    e.preventDefault();
    $('.errorMsg').html("");
    $('#successMsg').html("");
    $('#forgotSubmit').prop("disabled", true);
    $('#loader').html("");
    $.ajax({
        type:'post',
        url:"forgot-password/email",
        data: $('#forgotPasswordForm').serialize(),
        beforeSend: function(){
            $('#loader').html('<span class="spinner-border spinner-border-sm text-light ml-2"></span>');
        },
        success: function(result){
            console.log(result);
            $('#forgotSubmit').prop("disabled", false);
            $('#loader').html("");

            if(result.status == 'error'){
                $.each(result.error, function(key, val){
                    $('#'+key).html(val[0]);
                })
            }
            if(result.status == 'fail'){
                $('#successMsg').html(`<div class="alert alert-danger">${result.msg}</div>`);
            }  
            if(result.status == 'success'){
                $('#forgotPasswordForm')[0].reset();
                $('#successMsg').html(`<div class="alert alert-success">${result.msg}</div>`);

            }         
        }

    });
});


$('#recoverPasswordForm').submit((e)=>{
    e.preventDefault();
    $('.errorMsg').html("");
    $('#successMsg').html("");
    $('#recoverPassSubmit').prop("disabled", true);
    $('#loader').html("");
    $.ajax({
        type:'post',
        url:"password",
        data: $('#recoverPasswordForm').serialize(),
        beforeSend: function(){
            $('#loader').html('<span class="spinner-border spinner-border-sm text-light ml-2"></span>');
        },
        success: function(result){
            console.log(result);
            $('#recoverPassSubmit').prop("disabled", false);
            $('#loader').html("");

            if(result.status == 'fail'){
                $('#successMsg').html(`<div class="alert alert-danger">${result.msg}</div>`);
            }  
            if(result.status == 'success'){
                window.location.href=result.msg;
            }         
        }

    });
});

var getInt = (key)=>{
    return parseInt($('#'+key).text());
}

$('#couponForm').submit((e)=>{
    e.preventDefault();
    $('.errorMsg').html("");
    $('#successMsg').html("");
    $('#applyCoupon').prop("disabled", true);
    $('#loader2').html("");
    $.ajax({
        type:'post',
        url:"checkout/coupon",
        data: $('#couponForm').serialize(),
        beforeSend: function(){
            $('#loader2').html('<span class="spinner-border spinner-border-sm text-light ml-2"></span>');
        },
        success: function(result){
            console.log(result);
            $('#applyCoupon').prop("disabled", false);
            $('#loader2').html("");

            if(result.status == 'fail'){
                $('#coupon_code').text(result.msg);
            }
            if(result.status == 'error'){
                $.each(result.error, function(key, val){
                    $('#'+key).html(val[0]);
                })
            }
            if(result.status == 'success'){
                if(result.data.coupon_method == "cash"){
                    $('#discount').text(result.data.coupon_value);
                    $('#total').text( (getInt('subtotal') + 30 ) -  result.data.coupon_value );
                }
                if(result.data.coupon_method == "percentage"){
                    const getDis = (parseFloat(getInt('subtotal'))*parseFloat(result.data.coupon_value))/100; 
                    $('#discount').text(parseFloat(getDis));
                    $('#total').text( (parseFloat(getInt('subtotal')) + 30 ) -  parseFloat(getDis) );
                }
                swal("Your coupon code has been applied. Do not remove the code before order. Enjoy!", {
                    icon: "success",
                });
                
            }         
        }

    });
});

$('#orderForm').submit((e)=>{
    e.preventDefault();

    swal({
        title: "Are you sure?",
        text: "To order foods",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    .then((willDelete) => {
        if (willDelete) {
            $('.errorMsg').html("");
            $('#successMsg').html("");
            $('#placeOrder').prop("disabled", true);
            $('#loader').html("");
            $('#loader').html("");

            const subTotal = parseFloat(getInt('subtotal'));
            const discount = parseFloat(getInt('discount'));
            const shippingCost = parseFloat(getInt('shippingCost'));
            const couponCode = $('#coupon_code_val').val();
            const total = (subTotal + shippingCost) - discount;
            const data = $('#orderForm').serialize()+ "&subTotal=" + subTotal  + "&shippingCost=" + shippingCost + "&couponCode=" + couponCode;


            $.ajax({
                type:'post',
                url:"checkout/order",
                data: data,
                beforeSend: function(){
                    $('#loader').html('<span class="spinner-border spinner-border-sm text-light ml-2"></span>');
                },
                success: function(result){
                    console.log(result);
                    $('#placeOrder').prop("disabled", false);
                    $('#loader').html("");

                    if(result.status == 'fail'){
                        swal("Oops!", result.msg, "error");
                        // $('#successMsg').html(`<div class="alert alert-danger">${result.msg}</div>`);
                    }
                    if(result.status == 'error'){
                        $.each(result.error, function(key, val){
                            $('#'+key).html(val[0]);
                        })
                    }
                    if(result.status == 'success'){
                        window.location.href= result.msg;
                    }        
                }

            });
        }
    });

    
});

const getLang = data => {
    event.preventDefault();
    $.ajax({
        type:'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url:"locale",
        data: {_token : $('meta[name="csrf-token"]').attr('content'), lang:data},
        success: function(result){
            console.log(result);
            if(result.status == 'success'){
                window.location.href= window.location.href;
            }
        }

    });
}