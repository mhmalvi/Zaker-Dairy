<template>
  <div>
    <div class="d-flex align-items-center">
      <div class="form-group img-container">
        <label for="image_picker" class="img-container-lbl" v-if="!isUploading"
          >Click here to upload {{ state.label_text }}</label
        >
        <label for="" class="img-container-lbl" v-else> Uploading... </label>

        <div class="col-12 img-wrapper" v-if="state.image_dataUrl.length > 0">
          <a
            href="javascript:void(0)"
            @click.prevent="handleImageDelete()"
            class="text-danger d-block img-remove"
          >
            <i class="bi bi-trash"></i>
          </a>
          <img
            :src="state.image_dataUrl"
            class="img-thumbnail"
            :class="{ isCircular: 'rounded-circle' }"
            :width="imgWidth"
          />
        </div>
        <img
          :src="state.defaultImage"
          alt=""
          class="img-thumbnail"
          :class="{ isCircular: 'rounded-circle' }"
          :width="imgWidth"
          v-else
        />
        <input
          type="file"
          id="image_picker"
          class="form-control d-none"
          @change="handleImageChange"
        />
      </div>
    </div>
    <p v-if="state.errors.length > 0">
      {{ state.errors[0] }}
    </p>
  </div>
</template>

<script>
import { reactive, ref } from "vue";
import ImageHandler from "../../modules/ImageHandler";

export default {
  props: ["label", "circular", "width", "tag"],
  setup({ label, circular, width, tag }, context) {
    const shape = ref("");
    const imgWidth = ref("");
    const event_tag = tag ?? "";

    context.emit("change");

    if (circular != undefined) {
      shape.value = "circular";
    }
    if (width != undefined) {
      imgWidth.value = width;
    }
    const isUploading = ref(false);
    const state = reactive({
      label_text: label ?? "image",
      image_dataUrl: "",
      errors: [],
      defaultImage: `${window.location.origin}/images/default_image.png`,
    });

    const handleImageChange = (e) => {
      state.errors = [];
      if (e.target.files.length == 0) return;
      const file = e.target.files[0];

      ImageHandler.convertToDataUrl(file)
        .then((result) => {
          let event_name = "requestForChange" + event_tag;
          console.log("event name", event_name);
          context.emit(event_name, {
            image: result,
          });
        })
        .catch((err) => {
          state.errors.push(err.message);
        });
    };

    const handleImageDelete = () => {
      let event_name = "requestForDelete" + event_tag;
      context.emit(event_name);
    };

    const deleteImage = () => {
      state.image_dataUrl = "";
    };

    const setImage = (imageData) => {
      state.errors = [];
      state.image_dataUrl = imageData;
    };

    const turnOnUploading = () => {
      isUploading.value = true;
    };

    const turnOffUploading = () => {
      isUploading.value = false;
    };

    const isCircular = () => {
      if (shape.value == "circular") {
        return true;
      }
      return false;
    };

    return {
      state,
      isUploading,
      shape,
      imgWidth,
      handleImageChange,
      handleImageDelete,
      deleteImage,
      setImage,
      turnOnUploading,
      turnOffUploading,
      isCircular,
    };
  },
};
</script>
<!--
=======================================================================================
How to use this component?

  1. include this component in a vue template
  2. when this component has a new image selected by user, an event is dispatched.
     catch that event by @requestForChange
  3. you can listen to @requestForDelete for handling image delete action

*Note
  to visualize the added image in this component, you MUST use this component's
  setImage() function. otherwise the added image wont be visible

  example:
    <ImagePickerComponent ref="imagepicker" @requestForChange="handleChange" />

    const imagepicker = ref(0);

    const handleChange = (data) => {
        // handle the image data as you wish
        imagepicker.value.setImage(data.image)
    }

*Props: [label]
=======================================================================================
-->

<style scoped>
.thumbnail-select {
  cursor: pointer;
}
.img-container {
  border: 1px dashed;
  padding: 20px;
  text-align: center;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.img-container .img-container-lbl {
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

.img-container .img-container-lbl:hover {
  transform: scale(0.99);
  color: #30419b;
}

.img-wrapper {
  position: relative;
  padding: 5px;
}

.img-remove {
  position: absolute;
  top: 0;
  right: 0;
  margin: 15px;
  border: 1px solid #fff;
  padding: 1px 5px;
  border-radius: 50%;
  background-color: white !important;
}
</style>
