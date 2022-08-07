<template>
  <div class="row">
    <div class="col-md-7">
      <form @submit.prevent="handleFormSubmit">
        <div class="form-group">
          <label class="form-label">Title</label>
          <input type="text" class="form-control" v-model="state.form.title" />
          <p
            v-if="state.validation.errors && state.validation.errors.title"
            class="text-danger"
          >
            {{ state.validation.errors.title[0] }}
          </p>
        </div>

        <div class="form-group">
          <label class="form-label">Subtitle</label>
          <input
            type="text"
            class="form-control"
            v-model="state.form.subtitle"
          />
          <p
            v-if="state.validation.errors && state.validation.errors.subtitle"
            class="text-danger"
          >
            {{ state.validation.errors.subtitle[0] }}
          </p>
        </div>

        <div class="form-group">
          <label class="form-label">Button text</label>
          <input
            type="text"
            class="form-control"
            v-model="state.form.button_text"
          />
          <p
            v-if="
              state.validation.errors && state.validation.errors.button_text
            "
            class="text-danger"
          >
            {{ state.validation.errors.button_text[0] }}
          </p>
        </div>

        <div class="form-group">
          <label class="form-label">Button link</label>
          <input
            type="text"
            class="form-control"
            v-model="state.form.button_link"
          />
          <p
            v-if="
              state.validation.errors && state.validation.errors.button_link
            "
            class="text-danger"
          >
            {{ state.validation.errors.button_link[0] }}
          </p>
          <div class="link-options d-flex justify-content-between mt-2">
            <button
              class="btn btn-info btn-xs"
              type="button"
              @click="addShopLink()"
            >
              Add "Shop" link
            </button>
            <button
              class="btn btn-info btn-xs"
              type="button"
              @click="addContactLink()"
            >
              Add "Contact" link
            </button>
            <button
              class="btn btn-info btn-xs"
              type="button"
              @click="addAboutUsLink()"
            >
              Add "About us" link
            </button>
          </div>
        </div>

        <div class="form-group">
          <button class="btn btn-primary" :disabled="state.submitting">
            Save
          </button>
        </div>
      </form>
    </div>

    <div class="col-md-5">
      <div class="form-group">
        <label class="form-label">Image</label>

        <ImagePickerComponent
          ref="image_picker"
          @requestForChange="handleImageUpdate"
          @requestForDelete="handleImageDelete"
        />
        <small class="text-info">Choose an image with size of 1280x800</small>

        <p
          v-if="state.validation.errors && state.validation.errors.image"
          class="text-danger"
        >
          {{ state.validation.errors.image[0] }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, ref } from "vue";
import ImagePickerComponent from "./Common/ImagePickerComponent.vue";
import ScrollHandler from "../modules/ScrollHandler";

export default {
  components: {
    ImagePickerComponent,
  },
  setup(_, { emit }) {
    const image_picker = ref(0);
    const state = reactive({
      form: {
        id: "",
        title: "",
        subtitle: "",
        button_text: "",
        button_link: "",
        image: "",
      },
      validation: {
        errors: [],
        message: "",
      },
      submitting: false,
    });

    const setFormData = (data) => {
      state.form.button_link = data.button_link;
      state.form.button_text = data.button_text;
      state.form.id = data.id;
      state.form.image = data.image;
      state.form.subtitle = data.subtitle;
      state.form.title = data.title;

      image_picker.value.setImage(state.form.image);
    };

    const handleImageUpdate = (data) => {
      state.form.image = data.image;
      image_picker.value.setImage(data.image);
    };

    const handleImageDelete = () => {
      state.form.image = "";
      image_picker.value.deleteImage();
    };

    const handleFormSubmit = () => {
      state.submitting = true;
      state.validation = {
        errors: [],
        message: "",
      };

      emit("formSubmit", state.form);
    };

    const success = (res, reset = true) => {
      if (reset) formReset();
      alert(res.data.message);
    };

    const fail = (err) => {
      state.validation.errors = err.response.data.errors;
      state.validation.message = err.response.data.message;
    };

    const completed = () => {
      state.submitting = false;
      ScrollHandler.smoothScrollTop();
    };

    const formReset = () => {
      state.form = {
        title: "",
        subtitle: "",
        button_text: "",
        button_link: "",
        image: "",
      };

      image_picker.value.deleteImage();
    };

    const addShopLink = () => {
      state.form.button_link = prepareLink("/shop");
    };

    const addAboutUsLink = () => {
      state.form.button_link = prepareLink("/about-us");
    };

    const addContactLink = () => {
      state.form.button_link = prepareLink("/contact-us");
    };

    const prepareLink = (uri) => {
      return location.origin + uri;
    };

    return {
      state,
      image_picker,
      setFormData,
      handleImageUpdate,
      handleImageDelete,
      handleFormSubmit,
      addShopLink,
      addAboutUsLink,
      addContactLink,
      success,
      fail,
      completed,
    };
  },
};
</script>
