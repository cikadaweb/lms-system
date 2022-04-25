<template>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li :class="{ disabled: !pagination.prev_page_url  }" 
              @click.prevent="getPaginateItems(pagination.prev_page_url)"
              class="page-item">
              <a class="page-link" href="#">Назад</a>
            </li>

            <li class="page-item disabled">
              <a class="page-link" href="#">Страница {{ pagination.current_page }} из {{ pagination.last_page }}</a>
            </li>

            <li :class="{ disabled: !pagination.next_page_url  }"
              @click.prevent="getPaginateItems(pagination.next_page_url)"
              class="page-item">
              <a class="page-link" href="#">Следующая</a>
            </li>
          </ul>
        </nav>
</template>

<script>
import axios from "../../../axios/axios-instance";

export default {
  name: "Pagination",
  props: ["pagination_url"],
  emits: ["set-paginate-items"],
  data() {
    return {
      pagination: {}
    }
  },
  mounted() {
    this.getPaginateItems()
  },
  methods: {

    getPaginateItems(page_url) {
      page_url = page_url || this.pagination_url
        axios
            .get(page_url)
            .then((response) => {
                this.$emit("set-paginate-items", response.data.data)
                this.makePagination(response.data)
            })
            .catch((error) => {
                console.log(error);
            });
    },
    makePagination(response) {
      let pagination = {
        current_page: response.meta.current_page,
        last_page: response.meta.last_page,
        prev_page_url: response.links.prev,
        next_page_url: response.links.next
      }
      this.pagination = pagination
      // параметры пагинации
      console.log(pagination)

    },
  }

}
</script>

<style>

</style>