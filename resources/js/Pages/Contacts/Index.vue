<template>
  <AppLayout title="Contacts">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contacts
            </h2>
        </template>

      <div class="contanier">
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">

          <div class="px-6 py-4 flex items-center">
            <TextInput v-model="search" class="px-2 py-2 flex-1" placeholder="Add text to search" />
            <Link :href="route('contacts.create')" class="ml-4 flex-shrink-0 btn btn-blue">
                Create new contact
            </Link>
          </div>

          <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Organization</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">City</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Phone</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
              <tr v-for="(contact, index) in contacts.data" class="hover:bg-gray-50">
                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                  <div class="text-sm">
                    <div class="font-medium text-gray-700">
                      {{ contact.first_name }}  {{ contact.last_name }}
                    </div>
                    <div class="text-gray-400"> {{ contact.email }}</div>
                  </div>
                </th>
                <td class="px-6 py-4">
                  <span>
                    {{ contact.organization.name }}
                  </span>
                </td>
                <td class="px-6 py-4">{{ contact.city }}</td>
                <td class="px-6 py-4">{{ contact.phone }}</td>
                <td class="px-6 py-4">
                  <div class="flex justify-end gap-4">
                    <a x-data="{ tooltip: 'Edite' }" :href="route('contacts.edit', contact)">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6"
                        x-tooltip="tooltip"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                        />
                      </svg>
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <pagination :pagination="contacts" />
        </div>
      </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import TextInput from '@/Components/TextInput.vue';
import {Link} from '@inertiajs/vue3';

export default {
  components: {
    AppLayout,
    Pagination,
    TextInput,
    Link
  },

  data() {
    return {
      search: this.filters.search
    }
  },

  watch: {
    search() {
      this.$inertia.get('/contacts', {
          search: this.search
      },
      {
        preserveState: true,
      });
    }
  },

  props: {
    contacts: Object,
    filters: Object
  }
}

</script>

<style scoped>

</style>