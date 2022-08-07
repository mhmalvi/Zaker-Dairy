export default class ScrollHandler {
    static smoothScrollTop() {
        scrollTo({
            behavior: "smooth",
            top: 0,
        });
    }
}
