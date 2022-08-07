import { createApp } from "vue";

import CreateCategoryComponent from "./components/CreateCategoryComponent.vue";
import CategoryListComponent from "./components/CategoryListComponent";
import EditCategoryComponent from "./components/EditCategoryComponent";
import UsersListComponent from "./components/UsersListComponent.vue";
import EditUserComponent from "./components/EditUserComponent.vue";
import CheckoutFormComponent from "./components/CheckoutFormComponent.vue";
import UpdatePromotionalBannerComponent from "./components/UpdatePromotionalBannerComponent.vue";

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const app = createApp({});

app.component("QuillEditor", QuillEditor);
app.component("create-category-component", CreateCategoryComponent);
app.component("category-list-component", CategoryListComponent);
app.component("edit-category-component", EditCategoryComponent);

app.component("users-list-component", UsersListComponent);
app.component("edit-user-component", EditUserComponent);
app.component("checkout-form-component", CheckoutFormComponent);

app.component(
    "update-promotional-banner-component",
    UpdatePromotionalBannerComponent
);

app.mount("#app");

require("./bootstrap");

require("alpinejs");
