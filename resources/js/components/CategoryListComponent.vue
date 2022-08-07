<template>
  <div>
    <div class="row">
      <div class="col-6">
        <h4>Categories</h4>
      </div>
      <div class="col-6 d-flex justify-content-end">
        <button class="btn btn-primary-outline btn-sm mb-1" @click="refresh">
          <i class="bi bi-arrow-clockwise"></i>
        </button>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <select
          class="form-control"
          v-model="state.pagination_options.per_page"
        >
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
        </select>
      </div>
      <div class="col-sm-6">
        <input
          type="text"
          class="form-control"
          placeholder="Search..."
          v-model="state.pagination_options.search"
        />
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-sm-12">
        <div class="table">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="70px">#</th>
                <th>Category</th>
                <th>Parent Category</th>
              </tr>
            </thead>
            <tbody v-if="state.loading">
              <tr>
                <td colspan="12" class="text-center">Loading...</td>
              </tr>
            </tbody>
            <tbody v-else>
              <tr v-for="(category, index) in state.categories" :key="index">
                <td>
                  <!-- quick maths for calculating the index of the category -->
                  {{
                    (state.pagination_meta.current_page - 1) *
                      state.pagination_options.per_page +
                    index +
                    1
                  }}
                </td>
                <td>
                  <div class="d-flex justify-content-start">
                    <div>
                        <P>{{ category.thumbnail }}</P>
                      <img
                        :src="category.thumbnail"
                        :alt="category.category"
                        class="img-thumbnail"
                        width="60"
                        height="60"
                      />
                    </div>
                    <div class="ml-3">
                      {{ category.category }}
                      <div>
                        <a
                          href="javascript:void(0)"
                          class="btn-link"
                          @click="editCategory(category)"
                        >
                          Edit
                        </a>
                        <a
                          href="javascript:void(0)"
                          class="btn-link ml-2"
                          @click="attemptToDelete(category)"
                        >
                          Delete
                        </a>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <span v-if="category.parent">
                    {{ category.parent.category }}
                  </span>
                  <span v-else>---</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="row d-flex justify-content-center">
          <nav aria-label="Page navigation example" v-if="!state.loading">
            <ul class="pagination">
              <li
                class="page-item"
                :class="{ active: link.active }"
                v-for="(link, index) in state.pagination_meta.links"
                :key="index"
              >
                <a
                  class="page-link"
                  href="javascript:void(0)"
                  v-html="link.label"
                  :disabled="link.url == null"
                  @click.prevent="getPage(link.url)"
                ></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted, watch } from "vue";
import axios from "axios";
import _ from "lodash";

export default {
  setup() {
    const state = reactive({
      categories: [],
      loading: false,
      pagination_options: {
        per_page: 5,
        search: "",
      },
      pagination_meta: {
        current_page: 0,
        links: [],
      },
      action_link: "/admin/categories/list",
    });

    onMounted(() => {
      getCategories(state.action_link);
    });

    watch(
      () => state.pagination_options.search,
      _.debounce((newVal, oldVal) => {
        getCategories(state.action_link);
      }, 400)
    );
    watch(
      () => state.pagination_options.per_page,
      (newVal, oldVal) => {
        getCategories(state.action_link);
      }
    );

    const getCategories = (action) => {
      state.loading = true;
      axios
        .get(action, {
          params: {
            ...state.pagination_options,
          },
        })
        .then((response) => {
          state.categories = response.data.data;
          state.pagination_meta.links = response.data.meta.links;
          state.pagination_meta.current_page = response.data.meta.current_page;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          state.loading = false;
        });
    };

    const getEditLink = (category) => {
      return `/admin/categories/${category.slug}/edit`;
    };
    const getDeleteLink = (category) => {
      return `/admin/categories/${category.id}/delete`;
    };
    const editCategory = (category) => {
      window.location.href = getEditLink(category);
    };
    const attemptToDelete = (category) => {
      if (confirm("Are you sure you want to delete this category?")) {
        deleteCategory(category);
      }
    };
    const deleteCategory = (category) => {
      axios
        .delete("/admin/categories/" + category.slug + "/delete")
        .then((res) => {
          if (res.data.success) {
            getCategories(state.action_link);
          }
        })
        .catch((err) => {
          alert(err.response.data.message);
          console.error(err.response.data.error);
        });
    };

    const getPage = (url) => {
      getCategories(url);
    };

    const refresh = () => {
      getCategories(state.action_link);
    };

    return {
      state,
      refresh,
      editCategory,
      getPage,
      attemptToDelete,
    };
  },
};
</script>
