import Validators from "./Validators";

export default class ImageHandler {
    static async convertToDataUrl(image) {
        const { fileType } = Validators();
        return new Promise((resolve, reject) => {
            if (fileType(image.name)) {
                const file_reader = new FileReader();
                file_reader.readAsDataURL(image);

                file_reader.onload = (e) => {
                    resolve(e.target.result);
                };
            } else {
                reject({
                    message: "Image type invalid.",
                });
            }
        });
    }
}
