import { Mutation, Action, VuexModule, getModule, Module } from "vuex-module-decorators";
import Vuex from 'vuex';
import Vue from 'vue';

import IJob from "@root/front/models/IJob";
import ICond from "@root/front/models/ICond";

// state's interface
export interface IState {
    jobs: Array<IJob>
    jobDetail: IJob
    isShowDetail: boolean
}

// 検索条件 初期値
const dafaultCond: ICond = {category: '', content: '', price: null, attention: false}
// 仕事詳細 初期値
const dafaultJobDetail: IJob = {id: '', title: '', content: '', attention: false, job_category_id: '', image: '', sort_no: ''}

Vue.use(Vuex);
const store=new Vuex.Store({})

@Module({ dynamic: true, store, name: "state", namespaced: true })
class State extends VuexModule implements IState {
    // state
    jobs: Array<IJob> = [];
    cond: ICond = dafaultCond;
    jobDetail: IJob = dafaultJobDetail;
    isShowDetail: boolean = false;

    // getter
    public get getJobs(): Array<IJob> {
        return this.jobs
    }
    public get getCond(): ICond {
        return this.cond
    }
    public get getJobDetail(): IJob {
        return this.jobDetail
    }
    public get getIsShowDetail(): boolean {
        return this.isShowDetail
    }

    // mutation
    @Mutation
    public setJobs(value: Array<IJob>) {
        this.jobs = value;
    }
    @Mutation
    public setCond(value: ICond) {
        this.cond = value;
    }
    @Mutation
    public setJobDetail(value: IJob) {
        this.jobDetail = value;
    }
    @Mutation
    public setIsShowDetail(value: boolean) {
        this.isShowDetail = value;
    }

    // action
    @Action
    public openDetail(value: IJob) {
        this.setJobDetail(value)
        this.setIsShowDetail(true)
    }
    @Action
    public closeDetail() {
        this.setJobDetail(dafaultJobDetail)
        this.setIsShowDetail(false)
    }
    @Action
    public searchJob(value: ICond) {
        // 条件保存
        this.setCond(value)
        // 仕事一覧取得処理
        window.axios.post('/front/jobs', value).then(response => {
            this.setJobs(response.data)
        })
    }
}
export const state = getModule(State);
