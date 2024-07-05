const adminRouter = [
    {
        path: "/admin/",
        component: () => import("../layouts/DefaultLayout.vue"),
        children: [
            {
                path: "exam",
                name: "admin.exam",
                meta: { title: "Quản lý đề thi - Quizz App" },
                component: () => import("../pages/admin/Exam/Home.vue")
            },
            {
                path: "exam/create",
                name: "admin.exam.create",
                meta: { title: "Tạo đề thi - Quizz App" },
                component: () => import("../pages/admin/Exam/CreateExam.vue")
            },
            {
                path: "exam/:exam_id/edit",
                name: "admin.exam.edit",
                meta: { title: "Chỉnh sửa đề thi - Quizz App" },
                component: () => import("../pages/admin/Exam/EditExam.vue")
            },
            {
                path: "student",
                name: "admin.student",
                meta: { title: "Quản Lý Học Sinh - Quizz App" },
                component: () => import("../pages/admin/student/HomeStudent.vue")
            },
            {
                path: "student/:student_id/edit",
                name: "admin.student.edit",
                meta: { title: "Chỉnh sửa Học Sinh - Quizz App" },
                component: () => import("../pages/admin/student/EditStudent.vue")
            },
            {
                path: "student/create",
                name: "admin.student.create",
                meta: { title: "Tạo mới học sinh - Quizz App" },
                component: () => import("../pages/admin/student/CreateStudent.vue")
            }

        ]
    }
]


export default adminRouter;
