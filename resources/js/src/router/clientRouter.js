const clientRouter = [
    {
        path: "/",
        component: () => import("../layouts/DefaultLayout.vue"),
        children: [
            {
                path: "/",
                name: "quizz.index",
                meta: {title: "Trang Chủ - Quizz App", isAuth: true},
                component: () => import("../pages/client/Home.vue")
            },
            {
                path: "/auth/login",
                name: "quizz.auth.login",
                meta: {title: "Đăng nhập - Quizz App"},
                component: () => import("../pages/client/Login.vue")
            },
            {
                path: "/auth/register",
                name: "quizz.auth.register",
                meta: {title: "Đăng ký - Quizz App"},
                component: () => import("../pages/client/Register.vue")
            },
            {
                path: "/user/:username",
                name: "quizz.user.view",
                meta: {title: "Trang Cá Nhân - Quizz App", isAuth: true},
                component: () => import("../pages/client/InfoView.vue")
            },
            {
                path: "/user/:username/edit",
                name: "quizz.user.edit",
                meta: {title: "Chỉnh sửa hồ sơ - Quizz App", isAuth: true},
                component: () => import("../pages/client/EditCustom.vue")
            },
            {
                path: "/practice/join/:practice_id",
                name: "quizz.practice.join",
                meta: {title: "Bắt đầu kiểm tra - Quizz App", isAuth: true},
                component: () => import("../pages/client/Practice/StartPractice.vue")
            },
            {
                path: "/contest",
                name: "quizz.contest.index",
                meta: {title: "Danh Sách Kỳ Thi - Quizz App", isAuth: true},
                component: () => import("../pages/client/Exam/HomeExam.vue")
            },
            {
                path: "/contest/join/:contest_id",
                name: "quizz.contest.join",
                meta: {title: "Bắt đầu thi - Quizz App", isAuth: true},
                component: () => import("../pages/client/Exam/StartExam.vue")
            },
            {
                path: "/ranking",
                name: "quizz.rank",
                meta: {title: "Bảng xếp hạng - Quizz App", isAuth: true},
                component: () => import("../pages/client/Ranking.vue")
            },
        ]
    }
]


export default clientRouter;
