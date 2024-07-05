import { ElMessage, ElMessageBox } from "element-plus";


export default function confirmBox(message, type) {
    // console.log(message, type, options);
    return new Promise((resolve, reject) => {
        ElMessageBox.confirm(
            message,
            type,
            {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning',
            }
        )
            .then(() => {
                resolve(); // Giải quyết Promise thành công
            })
            .catch(() => {
                reject('call api error'); // Từ chối Promise
            });
    });
}
