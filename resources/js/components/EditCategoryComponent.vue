<template>
  <div>
    <CategoryFormComponent ref="form_component" @formSubmit="handleUpdate" />
  </div>
</template>

<script>
import CategoryFormComponent from "./CategoryFormComponent.vue";
import { onMounted, ref } from "vue";
import axios from "axios";

export default {
  components: { CategoryFormComponent },
  props: ["data"],
  setup({ data }) {
    const form_component = ref(0);
    const category = JSON.parse(data);

    onMounted(() => {
      form_component.value.setFormData(category);
      form_component.value.disableSlugGeneration();
    });

    const handleUpdate = (data) => {
      axios
        .patch("/admin/categories/" + category.slug + "/update", data)
        .then((res) => {
          form_component.value.success(res, false);
          if (res.data.refresh) {
            location.replace(res.data.refresh_link);
          }
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
      handleUpdate,
    };
  },
};
</script>
