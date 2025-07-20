<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';
// Components
import Button from '@/components/ui/button/Button.vue';
// Interfaces
interface Team {
    id: number;
    name: string;
    alias?: string;
    logo?: string;
}

// Props and data
const teams = ref<Team[]>([]);
const team1 = ref<Team | null>(null);
const team2 = ref<Team | null>(null);
const loading = ref(false);
const message = ref('');

onMounted(getTeams);
// Functions
async function getTeams() {
    try {
        const response = await axios.get<Team[]>('/api/teams');
        teams.value = response.data;
    } catch (error: any) {
        console.error('Error fetching teams:', error.response?.data ?? error);
    }
}
function playGame() {
    loading.value = true;
    if (!team1.value || !team2.value) {
        message.value = 'Please select both teams.';
        loading.value = false;
        return;
    }
    axios.post('/game/play', {
        team_1: team1.value.id,
        team_2: team2.value.id
    }).then(response => {
        console.log(response.data);

        message.value = `Selected teams: ${response.data.team_1.alias ?? response.data.team_1.name} vs ${response.data.team_2.alias ?? response.data.team_2.name}`;
    }).catch(error => {
        console.error('Error starting game:', error.response?.data ?? error);
    });

    loading.value = false;
}
</script>

<template>

    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
        <header class="mb-6 w-full max-w-[335px] not-has-[nav]:hidden lg:max-w-4xl">
            <nav class="flex items-center justify-end gap-4">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                Dashboard
                </Link>
                <template v-else>
                    <Link :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]">
                    Log in
                    </Link>
                    <Link :href="route('register')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]">
                    Register
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
            <main
                class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">
                <div
                    class="flex-1 rounded-br-lg rounded-bl-lg bg-white p-6 pb-12 text-[13px] leading-[20px] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] lg:rounded-tl-lg lg:rounded-br-none lg:p-20 dark:bg-[#161615] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
                    <h1 class="mb-1 font-medium">Let's get started</h1>
                    <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">
                        Laravel has an incredibly rich ecosystem. <br />We suggest starting with the following.
                    </p>
                    <ul class="mb-4 flex flex-col lg:mb-6">
                        <li
                            class="relative flex gap-4 py-2 before:absolute before:top-1/2 before:bottom-0 before:left-[0.4rem]">
                            <span class="relative bg-white py-1 dark:bg-[#161615]">
                                <span
                                    class="flex h-3.5 w-3.5 items-center justify-center rounded-full border border-[#e3e3e0] bg-[#FDFDFC] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] dark:border-[#3E3E3A] dark:bg-[#161615]">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A]" />
                                </span>
                            </span>
                            <div class="flex flex-col">
                                <span class="mb-1">
                                    Scegli due squadre
                                </span>
                                <select v-model="team1"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                    id="team1">
                                    <option disabled value="">Insert team 1...</option>
                                    <option v-for="team in teams" :key="team.id" :value="team">{{ team.alias ??
                                        team.name }}<img :src="team.logo" alt="" class="ml-2 h-4 w-4 inline" /></option>
                                </select>
                                <select v-model="team2"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                    id="team2">
                                    <option disabled value="">Insert team 2...</option>
                                    <option v-for="team in teams" :key="team.id" :value="team">{{ team.alias ??
                                        team.name }}<img :src="team.logo" alt="" class="ml-2 h-4 w-4 inline" /></option>
                                </select>

                            </div>
                        </li>
                        <li
                            class="relative flex items-center gap-4 py-2 before:absolute before:top-0 before:bottom-1/2 before:left-[0.4rem]">
                            <span class="relative bg-white py-1 dark:bg-[#161615]">
                                <span
                                    class="flex h-3.5 w-3.5 items-center justify-center rounded-full border border-[#e3e3e0] bg-[#FDFDFC] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] dark:border-[#3E3E3A] dark:bg-[#161615]">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A]" />
                                </span>
                            </span>
                            <span>
                                Scopri tutti i giocatori in comune!
                            </span>
                        </li>
                    </ul>
                    <ul class="flex gap-3 text-sm leading-normal">
                        <li>
                            <Button @click="playGame" :disabled="loading"
                                class="inline-block rounded-sm border border-black bg-[#1b1b18] px-5 py-1.5 text-sm leading-normal text-white hover:border-black hover:bg-black dark:border-[#eeeeec] dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:border-white dark:hover:bg-white">
                                Gioca!
                            </Button>
                        </li>
                    </ul>
                </div>
                <div
                    class="flex flex-col items-center justify-between p-12 lg:p-20 -mb-px aspect-335/376 w-full shrink-0 overflow-hidden rounded-t-lg bg-[#fff2f2] text-[#9999] lg:mb-0 lg:-ml-px lg:aspect-auto lg:w-[438px] lg:rounded-t-none lg:rounded-r-lg dark:bg-[#1D0002] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">
                    <div>
                        <h1>Istinto Puro</h1>
                    </div>
                    <div id="message" v-if="!loading && message">
                        {{ message }}
                    </div>
                    <div v-if="loading">Loading...</div>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
