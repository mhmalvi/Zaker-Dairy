<template>
  <div class="row">
    <div class="col-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Button Text</th>
            <th>Button Link</th>
          </tr>
        </thead>

        <tbody v-if="state.loading">
          <tr>
            <td class="text-center" colspan="12">Loading</td>
          </tr>
        </tbody>
        <tbody v-else-if="state.sliders.length == 0">
          <tr>
            <td class="text-center" colspan="12">No slider exists</td>
          </tr>
        </tbody>

        <tbody v-else>
          <tr v-for="(slider, index) in state.sliders" :key="index">
            <td>
              {{ index + 1 }}
            </td>
            <td>
              <img
                :src="slider.image"
                :alt="slider.title"
                class="img-thumbnail"
                width="80"
              />
            </td>
            <td>
              {{ slider.title }}
              <div>
                <a :href="getEditLink(slider)" class="btn-link">Edit</a>
                <a
                  href="javascript:void(0)"
                  @click="attemptDelete(slider)"
                  class="btn-link ml-2"
                  >Delete</a
                >
              </div>
            </td>
            <td>
              {{ slider.subtitle }}
            </td>
            <td>
              {{ slider.button_text }}
            </td>
            <td>
              {{ slider.button_link }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import axios from "axios";

export default {
  setup() {
    const state = reactive({
      sliders: [],
      loading: false,
    });

    onMounted(() => {
      fetchSliders();
    });

    const fetchSliders = () => {
      state.loading = true;
      axios
        .get("/admin/home_sliders/all")
        .then((res) => {
          state.sliders = res.data.data;
        })
        .finally(() => {
          state.loading = false;
        });
    };

    const getEditLink = (slider) => {
      return `/admin/home_sliders/${slider.id}/edit`;
    };

    const attemptDelete = (slider) => {
      if (confirm("Are you sure you want to delete this slider?")) {
        deleteSlider(slider);
      }
    };

    const deleteSlider = (slider) => {
      axios
        .delete(`/admin/home_sliders/${slider.id}`)
        .then(() => {
          fetchSliders();
        })
        .catch((err) => {
          alert(err.response.data.message);
        });
    };

    return {
      state,
      getEditLink,
      attemptDelete,
    };
  },
};
</script>
