import axios from "axios";

export default () => {
    const all = async () => {
        return axios.get("/admin/categories/raw");
    };

    const head_categories = async () => {
        return axios.get("/admin/categories/raw?only_parent=true");
    };

    return {
        all,
        head_categories,
    };
};
