<template>
    <footer class="footer d-flex">
        <div>
            <img class="img-ft" src="https://dmoj.ctu.edu.vn/static/icons/logo.svg" alt="">
        </div>
        <div>
            <div class="item-footer border-bottom">
                <!-- <font-awesome-icon style="font-size: 30px;" icon="building" /> <b> Đơn Vị</b> -->
            </div>
            <div>
                <ul>
                    <li><a href="#">Đại học Cần Thơ</a></li>
                    <li><a href="#">Hệ thống quản lý</a></li>
                    <li><a href="#">Trường CNTT&TT</a></li>
                    <li><a href="#">Đoàn Trường CNTT&TT</a></li>
                </ul>
            </div>
        </div>
        <div class="item-flex">
            <div class="item-footer border-bottom">
                <!-- <font-awesome-icon style="font-size: 30px;" icon="link" /> <b>Liên Kết</b> -->
            </div>
            <div>
                <ul>
                    <li><a href="#">Câu lạc bộ tin học</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Github</a></li>
                </ul>
            </div>
        </div>

    </footer>
</template>
<style scoped>
footer {
    justify-content: space-around;
    align-items: center;
    background: #1B1C1D;
    color: rgba(255, 255, 255, 0.9);
    padding: 80px 0;
    margin-top: 80px;
}

ul {
    list-style: none;
    justify-content: left;
}

li:not(:last-child) {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 8px;
}

ul li a {
    text-decoration: none;
    color: rgba(255, 255, 255, 0.5);
}

.img-ft {
    width: 200%;
}

.item-footer {
    font-size: 20px;
    margin-left: 31px;
    margin-bottom: 10px;
}

.icon-building {
    font-size: 40px;
}

.item-flex {
    margin-bottom: 32px;
}
</style>
