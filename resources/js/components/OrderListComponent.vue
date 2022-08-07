<template>
  <div>
    <div class="row">
      <div class="col-md-4 col-12">
        <select class="form-control" v-model="state.pagination_config.per_page">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
        </select>
      </div>

      <div class="col-md-4 offset-md-4 col-12">
        <input
          type="text"
          class="form-control"
          placeholder="Search (Order ID)"
          v-model="state.pagination_config.search"
        />
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>NO.</th>
              <th>Customer</th>
              <th>P.Method</th>
              <th>Amount (BDT)</th>
              <th>Ordered</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody v-if="state.loading">
            <tr>
              <td class="text-center" colspan="12">Loading</td>
            </tr>
          </tbody>
          <tbody v-else-if="!state.orders">
            <tr>
              <td class="text-center" colspan="12">No orders yet</td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr v-for="(order, index) in state.orders" :key="index">
              <td>
                {{ order.uuid }}
                <div>
                  <a :href="getViewLink(order)" class="btn-link">View</a>
                </div>
              </td>
              <td>
                {{ order.user ? order.user.name : "Guest User" }}
              </td>
              <td>Cash on delivery</td>
              <td>
                {{ order.total }}
              </td>
              <td>
                {{ order.created_at }}
              </td>
              <td>
                <select
                  class="form-control"
                  @change="handleStatusChange($event, index)"
                >
                  <option :selected="order.status == 'pending'" value="pending">
                    Pending
                  </option>
                  <option
                    :selected="order.status == 'approved'"
                    value="approved"
                  >
                    Approved
                  </option>
                  <option
                    :selected="order.status == 'delivered'"
                    value="delivered"
                  >
                    Delivered
                  </option>
                  <option
                    :selected="order.status == 'canceled'"
                    value="canceled"
                  >
                    Canceled
                  </option>
                </select>
                <small v-if="order.updating_status">Updating...</small>
              </td>
            </tr>
          </tbody>
        </table>

        <nav
          aria-label="Page navigation example"
          v-if="state.pagination_meta.links && !state.loading"
        >
          <ul class="pagination">
            <li
              class="page-item"
              v-for="(page, index) in state.pagination_meta.links"
              :class="{ active: page.active }"
              :key="index"
              :disabled="page.url == null"
            >
              <a
                class="page-link"
                href="javascript:void(0)"
                v-html="page.label"
                @click="updatePage(page.url)"
              ></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted, watch } from "vue";
import axios from "axios";
import useOrder from "../composables/useOrder";

export default {
  setup() {
    const state = reactive({
      orders: [],
      loading: false,
      pagination_config: {
        per_page: 10,
        search: "",
      },
      pagination_meta: {
        links: [],
        current_page: 1,
      },
      action_link: "/admin/orders/list",
    });
    const { updateStatus } = useOrder();

    onMounted(() => {
      fetchOrders(state.action_link);
    });

    watch(
      () => state.pagination_config.per_page,
      (per_page) => {
        fetchOrders(state.action_link);
      }
    );

    watch(
      () => state.pagination_config.search,
      _.debounce(() => {
        fetchOrders(state.action_link);
      }, 500)
    );

    watch(
      () => state.orders,
      (orders) => {}
    );

    const fetchOrders = async (link) => {
      state.loading = true;

      axios
        .get(link, {
          params: {
            ...state.pagination_config,
          },
        })
        .then((res) => {
          state.orders = res.data.data;
          state.pagination_meta.links = res.data.meta.links;
          state.pagination_meta.current_page = res.data.meta.current_page;
        })
        .catch((err) => {
          alert(err.response.message.data);
          console.log(err.response);
        })
        .finally(() => {
          state.loading = false;
        });
    };

    const updatePage = (url) => {
      fetchOrders(url);
    };

    const getViewLink = (order) => {
      return "/admin/orders/" + order.uuid;
    };

    const handleStatusChange = (e, index) => {
      const order = state.orders[index];
      if (order.status == e.target.value) return;

      state.orders[index].updating_status = true;
      updateStatus(order, e.target.value)
        .then((res) => {
          alert(res.data.message);
        })
        .catch((err) => {
          alert(err.response.data.message);
        })
        .finally(() => {
          state.orders[index].updating_status = false;
        });
    };

    return {
      state,
      updatePage,
      getViewLink,
      handleStatusChange,
    };
  },
};
</script>
