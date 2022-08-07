<template>
  <div>
    <HomeSlidersFormComponent ref="form_component" @formSubmit="handleCreate" />
  </div>
</template>

<script>
import HomeSlidersFormComponent from "./HomeSlidersFormComponent.vue";
import { ref } from "vue";
import ImagePickerComponent from "./Common/ImagePickerComponent.vue";
import axios from "axios";

export default {
  components: {
    HomeSlidersFormComponent,
    ImagePickerComponent,
  },
  setup() {
    const image_picker = ref(0);
    const form_component = ref(0);

    const handleCreate = (data) => {
      axios
        .post("/admin/home_sliders", data)
        .then((res) => {
          form_component.value.success(res);
        })
        .catch((err) => {
          form_component.value.fail(err);
        })
        .finally(() => {
          form_component.value.completed();
        });
    };

    return {
      form_component,
      image_picker,
      handleCreate,
    };
  },
};
</script>
