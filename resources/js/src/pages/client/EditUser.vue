<template>
    <div class="container container-big p-3 d-flex">
        <!-- <div class="row d-flex content-infoEdit"> -->
            <div id="content-left" class="col-md-3 p-3" style="width: 25%;">
                <div class="item-left">
                    <a class="first-page__info" style="color: #4d96ff;" href="#">Thông tin & liên hệ</a>
                </div>
                <div class="item-left">
                    <a href="#">Đổi tên người dùng</a>
                </div>
                <div class="item-left">
                    <a href="#">Đổi mật khẩu</a>
                </div>
                <div class="item-left">
                    <a href="#">Quản lý đội</a>
                </div>
            </div>
            <div id="content-right" class="col-md-9 p-3" style="width: 73%; margin-left: 17px;">
                <div class="title-right__info">
                    <h3>Thông Tin</h3>
                </div>
                <form action="">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="row" style="justify-content: center;">
                                <div id="ImgPreview" class="no-img"></div>
                            </div>
                            <div class="row avatar-selector">
                                <label for="Avatar" id="messageValidateImage" :style="{ display: inputDisplay }"  @focus="handleFocus">Ảnh đại diện của bạn</label>
                                <input name="ImgFile" id="Avatar" class="file" type="file" accept="image/png,image/x-png,image/gif,image/jpeg,image/jpg">
                                <div class="input-group">
                                    <span class="input-group-btn" :style="{ display: inputDisplay }"  @focus="handleFocus">
                                        <button class="browse btn btn-primary input-sm" type="button" id="Upload-Ava" onclick="document.getElementById('Avatar').click()" >Chọn ảnh</button>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="view-subject" for="FamilyName">Họ và tên</label>
                                </div>
                                <div class="col-lg-9">
                                    <span id="span-name" class="span-display" :style="{ display: spanDisplay }">Trần Hữu Lộc</span>
                                    <input id="FamilyName" class="FamilyInfo-input" :style="{ display: inputDisplay }" type="text" @focus="handleFocus">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="view-subject" for="BirthYear">Ngày sinh</label>
                                </div>
                                <div class="col-lg-9">
                                    <span id="span-birthYear" class="span-display" :style="{ display: spanDisplay }">17-12-2002</span>
                                    <input id="BirthYear" class="FamilyInfo-input" :style="{ display: inputDisplay }" type="text" @focus="handleFocus">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="view-subject" for="PhoneNumber">Số điện thoại</label>
                                </div>
                                <div class="col-lg-9">
                                    <span id="span-phone" class="span-display" :style="{ display: spanDisplay }">0365916243</span>
                                    <input id="PhoneNumber" class="FamilyInfo-input" :style="{ display: inputDisplay }" type="number" @focus="handleFocus">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="view-subject" for="EmailAddress">Địa chỉ Email</label>
                                </div>
                                <div class="col-lg-9">
                                    <span id="span-email" class="span-display" :style="{ display: spanDisplay }">loczw17120@gmail.com</span>
                                    <input id="EmailAddress" class="FamilyInfo-input" :style="{ display: inputDisplay }" type="email" @focus="handleFocus">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="view-subject" for="CountryId">Quốc gia/Vùng</label>
                                </div>
                                <div class="col-lg-9">
                                    <span id="span-country" class="span-display" :style="{ display: spanDisplay }">Việt Nam</span>
                                    <select name="CountrySelect" id="CountryId" class="FamilyInfo-input" :style="{ display: inputDisplay }"  @focus="handleFocus">
                                        <option>CampuChia</option>
                                        <option>Lào</option>
                                        <option>Mỹ Tho</option>
                                        <option>Thái Lan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="view-subject" for="CityId">Thành phố</label>
                                </div>
                                <div class="col-lg-9">
                                    <span id="span-city" class="span-display" :style="{ display: spanDisplay }">Đồng Tháp</span>
                                    <select name="CitySelect" id="CityId" class="FamilyInfo-input" :style="{ display: inputDisplay }"  @focus="handleFocus">
                                        <option>Cần Thơ</option>
                                        <option>An Giang</option>
                                        <option>Mỹ Đình</option>
                                        <option>Vĩnh Long</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="FacebookId">Facebook</label>
                                </div>
                                <div class="col-lg-9">
                                    <span id="span-fb" class="span-display" :style="{ display: spanDisplay }"></span>
                                    <input id="FacebookId" class="FamilyInfo-input" :style="{ display: inputDisplay }" type="text" @focus="handleFocus">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="summary">Mô tả bản thân</label>
                                </div>
                                <div class="col-lg-9">
                                    <span id="span-summary" class="span-display" :style="{ display: spanDisplay }"></span>
                                    <textarea name="Summary" id="summary" rows="5" class="FamilyInfo-textArea" :style="{ display: inputDisplay }"  @focus="handleFocus"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="achievement">Thành tích</label>
                                </div>
                                <div class="col-lg-9">
                                    <span id="span-achievement" class="span-display" :style="{ display: spanDisplay }"></span>
                                    <textarea name="Achievement" id="achievement" rows="5" class="FamilyInfo-textArea" :style="{ display: inputDisplay }"  @focus="handleFocus"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-submit__right">
                                    <button class="btn btn-sm" :style="{ display: inputDisplay }"  @focus="handleFocus">Hủy</button>
                                    <button class="btn btn-primary" :style="{ display: inputDisplay }"  @focus="handleFocus" >Lưu</button>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-1" style="padding-left: 30px;">
                            <a class="focus-display__span" href="#" @click="hideSpan"><font-awesome-icon style="color: black;" icon="pen" /></a>

                        </div>
                    </div>
                </form>
                <h2>Kinh Nghiệm</h2>
                <div class="exp-sumary">
                    <p>Mô tả kinh nghiệm làm việc của bạn.</p> <br>
                    <div class="plus-exp plus-item">
                        <font-awesome-icon style="color: white; font-size: 18px;" icon="plus" />
                    </div>
                </div>
                <h2>Học Vấn</h2>
                <div class="learn-sumary">
                    <p>Mô tả kinh nghiệm làm việc của bạn.</p> <br>
                    <div class="plus-learn plus-item">
                        <font-awesome-icon style="color: white; font-size: 18px;" icon="plus" />
                    </div>
                </div>

            </div>
        <!-- </div> -->

    </div>


</template>
<style scoped>
#content-right{
    background-color: #fff;

}
.item-left a {
    text-decoration: none;
    color: black;
}
.item-left{
    margin-bottom: 20px;

}
#ImgPreview.no-img{
    width: 100px;
    height: 100px;
    border: 1px solid #d8d8d8;
    border-radius: 50%;
    float: left;
    margin: 0 15px 0 15px;
    text-align: center;
    line-height: 100px;
    background-image: url(https://codelearn.io/Themes/TheCodeCampPro/Resources/Images/code-learn/img-preview-bg.png);
    background-color: #d8d8d8;
    background-position: center center;
    background-repeat: no-repeat;
}
.file{
    position: absolute;
    visibility: hidden;
}
label{
    color: #898989;
    font-size: 14px;
    line-height: 16px;
    font-weight: normal;
    text-align: center;
}
#content-left{
    background-color: #fff;

}
/* .container-big .content-infoEdit{
    justify-content: space-evenly;
} */
.input-group{
    justify-content: center;
    margin-top: 10px;
}
.FamilyInfo-input{
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 30px;
}
.FamilyInfo-textArea{
    width: 100%;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 30px;

}
.form-submit__right button{
    height: 35px;
    width: 104px;
    border-radius: 3px;
    line-height: inherit;
    display: block;
    margin: 0px 9px;
}
.form-submit__right button:hover{
    border:1px solid #4d96ff;
    box-shadow: 0 10px 10px 0 #d1e6ff;
    color: #4d96ff !important;
    background: #fff;
}
.btn-sm{
    border: 1px solid #c8c8c8;
}
.form-submit__right{
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: center;
}
.col-lg-3 .view-subject::after{
    content: "*";
    color: red;
    padding: 0px 5px;
    display: inline-block;
}
h3{
    padding: 0;
    margin: 0;
    color: #4d96ff;
    font-size: 24px;
    font-weight: bold;
    line-height: 28px;
    margin-bottom: 20px;
}
.FamilyInfo-input:focus {
  border-color: #66afe9;
  outline: none!important;;
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
}
.col-md-9 .row{
    /* align-items: center; */
    justify-content: center;
    vertical-align: middle;
    margin-bottom: 29px;
}
h2{
    padding: 0;
    margin: 0;
    color: #4d96ff;
    font-size: 24px;
    font-weight: bold;
    line-height: 28px;
    margin-bottom: 20px;
}
p{
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}
.plus-item{
    background-color: #4d96ff;
    display: inline-block;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    padding: 3px 7px;
}
.item-left a:not(.first-page__info):hover{
    color: #4d96ff;
    font-weight: bold;
}
</style>
<script>
export default {
  data() {
    return {
      spanDisplay: 'block',
      inputDisplay: 'none'
    };
  },
  methods: {
    hideSpan() {
      this.spanDisplay = 'none';
      this.inputDisplay = 'block';
    },
    handleFocus() {
      this.spanDisplay = 'none';
      this.inputDisplay = 'block';
    }
  },
  mounted() {
    this.inputDisplay = 'none';
  }
};
</script>
