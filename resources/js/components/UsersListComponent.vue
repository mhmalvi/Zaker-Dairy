<template>
  <div>
    <div class="row">
      <div class="table">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="70px">#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody v-if="state.loading">
            <tr>
              <td colspan="12" class="text-center">Loading...</td>
            </tr>
          </tbody>
          <tbody v-else-if="state.users.length == 0">
            <tr>
              <td colspan="12" class="text-center">No users found</td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr v-for="(user, index) in state.users" :key="index">
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
                {{ user.name }}
                <div>
                  <a :href="getEditLink(user)" class="btn-link">Edit</a>
                </div>
              </td>
              <td>
                {{ user.email }}
              </td>
              <td>
                <span
                  class="badge badge-success"
                  v-if="user.is_suspended == 'no'"
                >
                  Active
                </span>
                <span class="badge badge-danger" v-else> Suspended </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
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
              @click.prevent="getUsers(link.url)"
            ></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import axios from "axios";

export default {
  setup() {
    const state = reactive({
      users: [],
      action_link: "/admin/users/all",
      loading: false,
      pagination_options: {
        per_page: 10,
        search: "",
      },
      pagination_meta: {
        current_page: 0,
        links: [],
      },
      validation: {
        errors: [],
        message: "",
      },
    });

    onMounted(() => {
      getUsers(state.action_link);
    });

    const getUsers = (action_link) => {
      state.loading = true;
      axios
        .get(action_link, {
          params: state.pagination_options,
        })
        .then((res) => {
          state.users = res.data.data;
          state.pagination_meta.links = res.data.meta.links;
          state.pagination_meta.current_page = res.data.meta.current_page;
        })
        .catch((err) => {
          state.validation.errors = err.response.data.errors;
          state.validation.message = err.response.data.message;
        })
        .finally(() => {
          state.loading = false;
        });
    };

    const getEditLink = (user) => {
      console.log(user);
      return "/admin/users/" + user.uuid + "/edit";
    };

    return {
      state,
      getUsers,
      getEditLink,
    };
  },
};
</script>
