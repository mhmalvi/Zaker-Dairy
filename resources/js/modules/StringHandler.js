export default class StringHandler {
    static slug(title) {
        return title
            .toLowerCase()
            .replace(/ /g, "-")
            .replace(/[^\w-]+/g, "");
    }
}
