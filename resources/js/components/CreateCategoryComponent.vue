<template>
  <div>
    <category-form-component ref="form_component" @formSubmit="handleCreate" />
  </div>
</template>

<script>
import CategoryFormComponent from "./CategoryFormComponent.vue";
import axios from "axios";
import { ref } from "vue";

export default {
  components: {
    CategoryFormComponent,
  },
  setup() {
    const form_component = ref(0);

    const handleCreate = (data) => {
      axios
        .post("/admin/categories/store", data)
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
      handleCreate,
    };
  },
};
</script>
