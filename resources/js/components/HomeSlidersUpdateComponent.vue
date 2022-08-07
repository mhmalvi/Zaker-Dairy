<template>
  <div>
    <HomeSlidersFormComponent ref="form_component" @formSubmit="handleUpdate" />
  </div>
</template>

<script>
import HomeSlidersFormComponent from "./HomeSlidersFormComponent.vue";
import { ref, onMounted } from "vue";
import ImagePickerComponent from "./Common/ImagePickerComponent.vue";
import axios from "axios";

export default {
  components: {
    HomeSlidersFormComponent,
    ImagePickerComponent,
  },
  props: ["data"],
  setup({ data }) {
    const image_picker = ref(0);
    const form_component = ref(0);
    const home_slider = JSON.parse(data);

    onMounted(() => {
      form_component.value.setFormData(home_slider);
    });

    const handleUpdate = (data) => {
      axios
        .patch("/admin/home_sliders/" + data.id, data)
        .then((res) => {
          form_component.value.success(res, false);
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
      handleUpdate,
    };
  },
};
</script>

