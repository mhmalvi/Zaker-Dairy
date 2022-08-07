<template>
  <div class="card">
    <div class="card-body">
      <h3>Update Promotional Banner</h3>
      <div class="alert alert-success" v-if="state.success.message">
        {{ state.success.message }}
      </div>
      <div
        class="alert alert-danger"
        v-if="state.validation.message && !state.validation.errors"
      >
        {{ state.validation.message }}
      </div>
      <form @submit.prevent="handleFormSubmit">
        <div class="form-group">
          <label for="banner1" class="form-label">Promotional Banner 1</label>
          <input
            type="file"
            class="form-control"
            @change="handleBannerUpdate1"
          />
          <small class="text-info">Choose an image with size of 730x140</small>
          <p
            class="text-danger"
            v-if="state.validation.errors && state.validation.errors.image_1"
          >
            {{ state.validation.errors.image_1[0] }}
          </p>
        </div>

        <div class="form-group">
          <label for="banner2" class="form-label">Promotional Banner 2</label>
          <input
            type="file"
            class="form-control"
            @change="handleBannerUpdate2"
          />
          <small class="text-info">Choose an image with size of 350x140</small>
          <p
            class="text-danger"
            v-if="state.validation.errors && state.validation.errors.image_2"
          >
            {{ state.validation.errors.image_2[0] }}
          </p>
        </div>

        <div class="form-group">
          <button
            class="btn btn-primary btn-block"
            :disabled="state.submitting"
          >
            Save
          </button>
        </div>
      </form>

      <div id="preview">
        <div class="form-group">
          <label class="form-label">Preview</label>
          <div class="card">
            <div
              class="card-body d-flex justify-content-center"
              v-if="state.preview.loading"
            >
              <h5>Loading</h5>
            </div>
            <div
              class="card-body d-flex justify-content-center"
              v-else-if="state.preview.updated"
            >
              <button class="btn btn-primary" @click="preview_again()">
                Click here to preview
              </button>
            </div>
            <div class="card-body row d-flex justify-content-center" v-else>
              <div class="col-md-8" v-if="state.preview.image_1">
                <div class="row">
                  <div class="col-md-12 d-flex justify-content-start">
                    <button
                      class="btn btn-outline-danger btn-xs"
                      @click="deleteBanner1()"
                    >
                      <i class="bi bi-x-lg"></i>
                    </button>
                  </div>
                  <div class="col-md-12 mt-2">
                    <img :src="state.preview.image_1" class="img-fluid" />
                  </div>
                </div>
              </div>
              <div class="col-md-4" v-if="state.preview.image_2">
                <div class="row">
                  <div class="col-md-12 d-flex justify-content-end">
                    <button
                      class="btn btn-outline-danger btn-xs"
                      @click="deleteBanner2()"
                    >
                      <i class="bi bi-x-lg"></i>
                    </button>
                  </div>
                  <div class="col-md-12 mt-2">
                    <img :src="state.preview.image_2" class="img-fluid" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import axios from "axios";
import ImageHandler from "../modules/ImageHandler";

export default {
  setup() {
    const state = reactive({
      form: {
        image_1: "",
        image_2: "",
      },
      preview: {
        image_1: "",
        image_2: "",
        loading: false,
        updated: false,
      },
      validation: {
        errors: [],
        message: "",
      },
      success: {
        message: "",
      },
      submitting: false,
    });

    onMounted(() => {
      fetchBannerImages();
    });

    const fetchBannerImages = async () => {
      state.preview.loading = true;
      axios
        .get(`/admin/promotional_banners`)
        .then((res) => {
          state.preview.image_1 = res.data.path_1;
          state.preview.image_2 = res.data.path_2;
        })
        .finally(() => {
          state.preview.loading = false;
        });
    };

    const handleBannerUpdate1 = (e) => {
      if (e.target.files.length == 0) return;
      const file = e.target.files[0];

      ImageHandler.convertToDataUrl(file).then((result) => {
        state.form.image_1 = result;
      });
    };

    const handleBannerUpdate2 = (e) => {
      if (e.target.files.length == 0) return;
      const file = e.target.files[0];

      ImageHandler.convertToDataUrl(file).then((result) => {
        state.form.image_2 = result;
      });
    };

    const handleFormSubmit = () => {
      state.validation = {
        errors: [],
        message: "",
      };
      state.submitting = true;

      axios
        .post("/admin/promotional_banners/update", {
          image_1: state.form.image_1,
          image_2: state.form.image_2,
        })
        .then((res) => {
          state.success.message = res.data.message;

          //   state.preview.updated = true;
          fetchBannerImages();
        })
        .catch((err) => {
          console.log(err);
          state.validation = err.response.data;
        })
        .finally(() => {
          state.submitting = false;
        });
    };

    const preview_again = () => {
      location.reload();
    };

    const deleteBanner1 = () => {
      state.preview.loading = true;
      axios
        .delete("promotional_banners/1")
        .then((res) => {
          state.preview.image_1 = "";
        })
        .finally(() => {
          state.preview.loading = false;
        });
    };

    const deleteBanner2 = () => {
      state.preview.loading = true;
      axios
        .delete("promotional_banners/2")
        .then((res) => {
          state.preview.image_2 = "";
        })
        .finally(() => {
          state.preview.loading = false;
        });
    };

    return {
      state,
      handleBannerUpdate1,
      handleBannerUpdate2,
      handleFormSubmit,
      preview_again,
      deleteBanner1,
      deleteBanner2,
    };
  },
};
</script>
