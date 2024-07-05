<template>
    <main id="layout-main" class="group">
        <div id="layout-content" class="group">
            <div id="content" class="group">
                <div class="zone zone-content">


                    <div id="my-cv" class="container user-cv">
                        <div id="cv-left" class="col-md-3 col-sm-12 white">
                            <div id="user-profile">
                                <div class="user-avatar">
                                    <img id="level-avatar" class="level-avatar" src="../../assets/images/User-03.svg">
                                    <img id="img-user" src="../../assets/images/user-default.svg">
                                </div>
                                <span id="user-name" title="">{{ user.username }}</span>
                                <div>
                                    <span id="number-coin"></span>
                                    <span class="user-level"><span id="level"></span></span>
                                    <div style="text-align: center">
                                        <span class="total-xp-label">EXP: </span>
                                        <span id="total-xp" class="total-xp"><a
                                                href="/userlevel/exphistory/5494918">252</a></span>
                                    </div>
                                </div>
                                <!-- <div class="level-progress">

                                    <div class="current-level-info xp-level-info"><img
                                            src="/Themes/TheCodeCampPro/Resources/Images/level-avatars/User-03_mini.svg?v=3"
                                            class="mini-level-avatar current-level-avatar">
                                        <div class="xp-level-info-tooltip"><span>EXP: 151</span></div>
                                    </div>
                                    <div class="current-progress">

                                        <div class="standard-progress-bar" style="position: relative; overflow: hidden;">
                                            <div class="background"
                                                style="overflow: hidden; width: 67.3333%; position: absolute; left: 0px; top: 0px; height: 100%;">
                                                <div class="background-render"
                                                    style="background: linear-gradient(to right, rgb(92, 236, 209), rgb(49, 111, 196)); height: 100%; width: 636px;">
                                                </div>
                                            </div> <span class="text" style="z-index: 1;">101/150</span>
                                        </div>
                                        <span class="level-no">Cấp độ 3</span>
                                    </div>
                                    <div class="next-level-info xp-level-info"><img
                                            src="/Themes/TheCodeCampPro/Resources/Images/level-avatars/User-04_mini.svg?v=3"
                                            class="mini-level-avatar next-level-avatar">
                                        <div class="xp-level-info-tooltip right-aligned"><span>EXP: 301</span></div>
                                    </div>
                                </div> -->

                            </div>

                            <div class="break-line"></div>

                            <div id="infomation">
                                <h3>Thông tin</h3>
                                <ul id="user-info-section">
                                    <li>
                                        <span>{{ user.email }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="break-line"></div>

                            <div id="container-user-achievement">
                                <h3>
                                    Thành tích

                                    <i data-toggle="modal" data-target="#modal-edit-achievement" id="edit-achievement"
                                        class="cl-icon-pen pull-right" style="margin-right:12px;"></i>
                                </h3>


                                <ul id="user-achievement"></ul>
                                <span id="more-achievement" class="hide">Xem thêm</span>
                            </div>

                            <div class="break-line"></div>


                        </div>

                        <div id="cv-right" class="col-md-9 col-sm-12">
                            <div id="section-contest" class="right-section hide">
                                <h3 class="right-section-header">
                                    Cuộc thi
                                    <span id="h3-section-contest" class="user-cv-total-records"> (0)</span>
                                    <span id="contest-dropdown" class="header-dropdown">
                                        <div class="dropdown dropdown-selector"><button class="dropdown-toggle"
                                                type="button" data-toggle="dropdown"><span class="selected-text">Tất
                                                    cả</span><span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li data-value="Tất cả"><a href="javascript:void">Tất cả</a></li>
                                                <li data-value="Đã tạo"><a href="javascript:void">Đã tạo</a></li>
                                                <li data-value="Tham gia"><a href="javascript:void">Tham gia</a></li>
                                                <li data-value="Đã kết thúc"><a href="javascript:void">Đã kết thúc</a></li>
                                            </ul>
                                        </div>
                                    </span>
                                    <span id="contest-expand" class="contest-expand contest-expand-disable"><label
                                            class="contest-label-expand" id="contest-label-expand">Xem thêm</label></span>
                                    <span id="contest-collapse" class="contest-expand contest-expand-disable"><label
                                            class="contest-label-expand">Ẩn</label></span>
                                </h3>
                                <div class="row" id="contest-section-body"><span class="no-items">Không có cuộc thi
                                        nào</span></div>
                                <h3 class="right-section-header contest-expand-disable" id="h3-contest-expand-under">
                                    <span id="contest-expand-under" class="contest-expand"><label
                                            class="contest-label-expand" id="contest-label-expand-under">Xem
                                            thêm</label></span>
                                </h3>

                            </div>

                            <div id="challenges" class="right-section">
                                <h3 class="right-section-header">Luyện tập</h3>
                                <div id="container-challenge" class="white">
                                    <ul id="challenge-badge" class="challenge-badge">
                                        <li>
                                            <img src="../../assets/images/badge-created.svg">
                                            <div class="badge-label created"><span></span>Đã tạo</div>
                                            <div class="badge-point created">
                                                <div id="challenge-created">0</div>
                                                <span>Bài tập</span>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="../../assets/images/badge-1.svg">
                                            <div class="badge-label easy">
                                                <span id="challenge-easy">0</span>
                                                <span>bài đơn giản</span>
                                                <span class="badge-sub-text">đã làm</span>
                                            </div>
                                            <div class="badge-point">
                                                <div id="total-easy-challenge">0</div>
                                                <span class="badge-point-icon"><i class="cl-icon-heart-full"></i></span>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="../../assets/images/badge-1.svg">
                                            <div class="badge-label medium">
                                                <span id="challenge-medium">0</span>
                                                <span>bài trung bình</span>
                                                <span class="badge-sub-text">đã làm</span>
                                            </div>
                                            <div class="badge-point">
                                                <div id="total-medium-challenge">0</div>
                                                <span class="badge-point-icon"><i class="cl-icon-heart-full"></i></span>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="../../assets/images/badge-1.svg">
                                            <div class="badge-label hard">
                                                <span id="challenge-hard">0</span>
                                                <span>bài phức tạp </span>
                                                <span class="badge-sub-text">đã làm</span>
                                            </div>
                                            <div class="badge-point">
                                                <div id="total-hard-challenge">0</div>
                                                <span class="badge-point-icon"><i class="cl-icon-heart-full"></i></span>
                                            </div>
                                        </li>

                                        <li>
                                            <img src="../../assets/images/badge-total.svg">
                                            <div class="badge-label total"><span id="challenge-total"></span> Tổng điểm
                                            </div>
                                            <div class="badge-point">
                                                <div id="total-point-challenge">0</div>
                                                <span class="badge-point-icon"><i class="cl-icon-heart-full"></i></span>
                                            </div>
                                        </li>
                                    </ul>

                                </div>

                                <div id="create-challenge" class="white hide inner-frame">
                                    <div class="right-section-title">
                                        <h4>Đã tạo</h4><span class="view-all-link">Xem toàn bộ</span>
                                        <span id="h3-section-task-created" class="user-cv-total-records">(0)</span>
                                        <span id="challenges-created-expand"
                                            class="challenges-created-expand challenges-expand-disable">
                                            <label class="challenges-created-label-expand "
                                                id="challenges-created-label-expand">Xem thêm</label>
                                        </span>
                                        <span id="challenges-created-collapse"
                                            class="challenges-created-expand challenges-expand-disable"><label
                                                class="challenges-created-label-expand">Ẩn</label></span>
                                    </div>
                                    <table class="table" id="created-challenge-table">
                                        <tbody>
                                            <tr class="header-row">
                                                <td>Tên bài</td>
                                                <td><i class="img-col-header cl-icon-users-alt user"></i></td>
                                                <td><i class="cl-icon-heart-full img-col-header point"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h3 class="challenges-expand-disable" id="h3-challenges-created-expand-under">
                                        <span id="challenges-created-expand-under" class="challenges-created-expand"><label
                                                class="challenges-created-label-expand"
                                                id="challenges-created-label-expand-under">Xem thêm</label></span>
                                    </h3>
                                </div>

                                <div id="joined-challenge" class="white inner-frame">
                                    <div class="right-section-title">
                                        <h4>Đã tham gia</h4><span class="view-all-link">Xem toàn bộ</span>
                                        <span id="h3-section-task-joined" class="user-cv-total-records">(0)</span>
                                        <span id="challenges-joined-expand"
                                            class="challenges-joined-expand challenges-expand-disable">
                                            <label class="challenges-joined-label-expand"
                                                id="challenges-joined-label-expand">Xem thêm</label>
                                        </span>
                                        <span id="challenges-joined-collapse"
                                            class="challenges-joined-expand challenges-expand-disable"><label
                                                class="challenges-joined-label-expand"
                                                id="challenges-joined-label-collapse">Ẩn</label></span>
                                    </div>
                                    <table class="table" id="joined-challenge-table">
                                        <tbody>
                                            <tr class="header-row">
                                                <td>Tên bài</td>
                                                <td><i class="cl-icon-code img-col-header lang"></i></td>

                                                <td><i class="cl-icon-heart-full img-col-header point"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h3 class="challenges-expand-disable" id="h3-challenges-joined-expand-under">
                                        <span id="challenges-joined-expand-under" class="challenges-joined-expand"><label
                                                class="challenges-joined-label-expand"
                                                id="challenges-joined-label-expand-under">Xem thêm</label></span>
                                    </h3>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="space"></div>
                    <!-- Modal -->
                    <div class="modal fade" id="mode-delete-education" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Xác nhận</h4>
                                </div>
                                <div class="modal-body">
                                    <span>Bạn có chắc là muốn xóa thông tin này?</span>
                                </div>
                                <div class="modal-footer">
                                    <a id="delete-education" href="javascript:void(0)" class="btn btn-primary"
                                        data-dismiss="modal">Có</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Confirm Delete Experience -->
                    <div class="modal fade" id="mode-delete-exp" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Xác nhận</h4>
                                </div>
                                <div class="modal-body">
                                    <span>Bạn có chắc là muốn xóa thông tin này?</span>
                                </div>
                                <div class="modal-footer">
                                    <a id="delete-exp" href="javascript:void(0)" class="btn btn-primary"
                                        data-dismiss="modal">Có</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-edit-achievement" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"></button>
                                    <h4 class="modal-title">Thành tích</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Thành tích</label>
                                        <textarea id="user-achievement-data" rows="10" name="achievement" type="text"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="event-edit-achievement" type="button" class="btn btn-success">Lưu</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { onMounted, computed } from 'vue';
import { authenStore } from '../../store/authenStore';


export default {
    setup() {
        const auth = authenStore();
        const user = computed(() => auth.user)

        return { user }
    }
}
</script>

<style scoped>
@import url('../../assets/css/bootstrap.min.css');
@import url('../../assets/css/site.css');
@import url('../../assets/css/user.css');
</style>
