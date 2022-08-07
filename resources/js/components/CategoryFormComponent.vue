<template>
  <form @submit.prevent="handleFormSubmit">
    <div class="alert alert-success" v-if="state.success_message">
      {{ state.success_message }}
    </div>
    <div
      class="alert alert-danger"
      v-if="state.error_message && state.errors == null"
    >
      {{ state.error_message }}
    </div>
    <div class="form-group">
      <label for="name" class="form-label">Category</label>
      <input type="text" class="form-control" v-model="state.form.category" />
      <small class="text-danger" v-if="state.errors && state.errors.category">
        {{ state.errors.category[0] }}
      </small>
    </div>

    <div class="form-group">
      <div class="d-flex justify-content-between">
        <label for="parent_id" class="form-label">Parent category</label>
        <div
          class="spinner-border spinner-border-sm text-secondary"
          role="status"
          v-if="state.loading_categories"
        >
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <select class="form-control" v-model="state.form.parent_id">
        <option value="">-----</option>

        <option
          v-for="(category, index) in state.categories"
          :value="category.uuid"
          :key="index"
        >
          {{ category.category }}
        </option>
      </select>
      <small class="text-danger" v-if="state.errors && state.errors.parent_id">
        {{ state.errors.parent_id[0] }}
      </small>
    </div>

    <div class="form-group">
      <label for="name" class="form-label">Slug</label>
      <input type="text" class="form-control" v-model="state.form.slug" />
      <small class="text-danger" v-if="state.errors && state.errors.slug">
        {{ state.errors.slug[0] }}
      </small>
    </div>

    <div class="form-group">
      <label for="name" class="form-label">Details</label>
      <textarea class="form-control" v-model="state.form.details"></textarea>
      <small class="text-danger" v-if="state.errors && state.errors.details">
        {{ state.errors.details[0] }}
      </small>
    </div>

    <div class="form-group">
      <label for="name" class="form-label">Thumbnail</label>
      <ImagePickerComponent
        ref="image_picker"
        @requestForChange="changeThumbnail"
        @requestForDelete="deleteThumbnail"
        :width="80"
      />
      <small class="text-danger" v-if="state.errors && state.errors.thumbnail">
        {{ state.errors.thumbnail[0] }}
      </small>
    </div>

    <div class="form-group">
      <button class="btn btn-primary btn-block" :disabled="state.isSubmitting">
        Save
      </button>
    </div>
  </form>
</template>

<script>
import ImagePickerComponent from "./Common/ImagePickerComponent.vue";
import { reactive, ref, watch, onMounted } from "vue";
import StringHandler from "../modules/StringHandler";
import ScrollHandler from "../modules/ScrollHandler";
import useCategory from "../composables/useCategory";

export default {
  components: {
    ImagePickerComponent,
  },
  setup(_, { emit }) {
    const state = reactive({
      form: {
        uuid: "",
        category: "",
        parent_id: "",
        slug: "",
        details: "",
        thumbnail: "",
      },
      categories: [],
      isSubmitting: false,
      auto_generate_slug: true,
      errors: [],
      error_message: "",
      success_message: "",
      loading_categories: false,
    });
    const image_picker = ref(0);

    const { head_categories: getCategories } = useCategory();

    onMounted(() => {
      fetchCategories();
    });

    watch(
      () => state.form.category,
      (newVal, oldVal) => {
        if (state.auto_generate_slug) {
          console.log(state.auto_generate_slug);
          state.form.slug = StringHandler.slug(newVal);
        }
      }
    );

    const fetchCategories = () => {
      state.loading_categories = true;
      getCategories()
        .then((response) => {
          state.categories = response.data.data;
        })
        .catch((err) => {
          alert("Something went wrong!");
          console.error(err.response);
        })
        .finally(() => {
          state.loading_categories = false;
        });
    };

    const setFormData = (data) => {
      state.form.uuid = data.uuid ?? null;
      state.form.category = data.category;
      state.form.slug = data.slug;
      state.form.details = data.details;
      state.form.thumbnail = data.thumbnail;

      if (data.thumbnail) {
        image_picker.value.setImage(data.thumbnail);
      }
    };
    const disableSlugGeneration = () => {
      state.auto_generate_slug = false;
    };

    const handleFormSubmit = () => {
      state.isSubmitting = true;
      state.errors = [];
      state.error_message = "";
      state.success_message = "";

      emit("formSubmit", state.form);
    };

    const success = (res, reset = true) => {
      if (reset) {
        formReset();
      }
      state.success_message = res.data.message;

      ScrollHandler.smoothScrollTop();

      fetchCategories();
    };
    const fail = (err) => {
      if (err.response.status == 422) {
        state.errors = err.response.data.errors;
        state.error_message = err.response.data.message;
      } else {
        state.errors = null;
        state.error_message = err.response.data.message;
      }

      ScrollHandler.smoothScrollTop();
    };
    const completed = () => {
      state.isSubmitting = false;
    };

    const formReset = () => {
      state.form.category = "";
      state.form.parent_id = "";
      state.form.slug = "";
      state.form.details = "";
      state.form.thumbnail = "";

      image_picker.value.deleteImage();
    };

    const changeThumbnail = ({ image }) => {
      state.form.thumbnail = image;
      image_picker.value.setImage(image);
    };
    const deleteThumbnail = () => {
      state.form.thumbnail = "";
      image_picker.value.deleteImage();
    };

    return {
      state,
      image_picker,
      setFormData,
      disableSlugGeneration,
      handleFormSubmit,
      changeThumbnail,
      deleteThumbnail,
      success,
      fail,
      completed,
    };
  },
};
</script>
