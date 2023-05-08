<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0"><Button @click="addModal=true"><Icon type="md-add" />Add Account Sub Account</Button></p>

                    <div class="_overflow _table_div">
                        <table class="_table">
                            <!-- TABLE TITLE -->
                            <tr>
                                <th>ID</th>
                                <th>Party Transaction</th>
                                <th>Account</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Action</th>
                            </tr>
                            <!-- TABLE TITLE -->

                            <!-- ITEMS -->
                            <tr v-for="(items, i) in setData" :key="i" v-if="setData.length">
                                <td>{{items.id}}</td>
                                <td class="_table_name">{{items.party_transaction.party.name}}-{{items.party_transaction.transaction.name}}</td>
                                <td>{{items.account.name}}</td>
                                <td>{{items.dr}}</td>
                                <td>{{items.cr}}</td>
                                <td>
                                    <Button type="info" size="small" @click="showEditModal(items, i)">Edit</Button>
                                    <Button type="error" size="small" @click="showDeletingModal(items, i)"  :loading="items.isDeleting">Delete</Button>
                                    <Button type="success" size="small" @click="showStatusesModal(items, i)">{{items.is_active == 1 ? 'Active' : 'Deactive'}}</Button>
                                    <Button type="warning" size="small" @click="showShowsModal(items, i)">{{items.is_show == 1 ? 'Showing' : 'Not Showing'}}</Button>

                                </td>
                            </tr>
                            <!-- ITEMS -->
                        </table>
                    </div>
                </div>


                <!-- adding modal -->
                <Modal v-model="addModal" title="Add Party Account Transaction" :mask-closable="false" :closable="false">
                    <div class="space">
                        <select v-model="data.party_id" v-on:change="getTransactions" placeholder="Select Party" class="form-control">
                            <option  :value="r.id" v-for="(r, i) in party" :key="i" v-if="party.length">{{r.name}}</option>
                        </select>
<!--                        <Select v-model="data.party_id"  placeholder="Select Party"  @change="getTransactions(this.value)">-->
<!--                            <Option :value="r.id" v-for="(r, i) in party" :key="i" v-if="party.length"  @change="getTransactions(this.value)">{{r.name}}</Option>-->
<!--                        </Select>-->
                    </div>
                    <div class="space">
                        <Select v-model="data.transaction_id"  placeholder="Select Transaction">
                            <Option :value="r.id" v-for="(r, i) in party" :key="i" v-if="party.length">{{r.name}}</Option>
                        </Select>
                    </div>
                    <div class="space">
                        <Select v-model="data.account_id"  placeholder="Select Account">
                            <Option :value="r.id" v-for="(r, i) in accounts" :key="i" v-if="accounts.length">{{r.name}}</Option>
                        </Select>
                    </div>
                    <div class="space">
                        <Input type="text" v-model="data.amount" placeholder="Amount" autocomplete="off" />
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <input type="radio" :value="1" v-model="data.dr">Credit
                        </div>
                        <div class="col-2">
                        <input type="radio" :value="2" v-model="data.dr">Debit
                        </div>
                    </div>
                    <div slot="footer" style="margin-top:20px">
                        <Button type="default" @click="addModal=false">Close</Button>
                        <Button type="primary" @click="addItem" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add  Party Transaction'}}</Button>
                    </div>
                </Modal>
                <!-- editing modal -->
                <Modal v-model="editModal" title="Edit Role" :mask-closable="false" :closable="false">
                    <div class="space">
                        <Select v-model="editData.party_id"  placeholder="Select Party Transaction">
                            <Option :value="r.id" v-for="(r, i) in party" :key="i" v-if="party.length">{{r.name}}</Option>
                        </Select>
                    </div>
                    <div class="space">
                        <Select v-model="editData.account_id"  placeholder="Select Account">
                            <Option :value="r.id" v-for="(r, i) in accounts" :key="i" v-if="accounts.length">{{r.name}}</Option>
                        </Select>
                    </div>
                    <div class="space">
                        <Input type="text" v-model="editData.amount" placeholder="Debit" autocomplete="off" />
                    </div>
                    <div class="space">
                        <div class="row">
                            <div class="col-3">
                                <input type="radio" :value="1" v-model="data.dr">Debit
                            </div>
                                <div class="col-3">

                                <input type="radio" :value="2" v-model="data.dr">Credit
                            </div>
                        </div>
                    </div>
                    <div slot="footer">
                        <Button type="default" @click="editModal=false">Close</Button>
                        <Button type="primary" @click="editItemBtn" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing..' : 'Edit Party Transaction'}}</Button>
                    </div>
                </Modal>
                <!-- delete alert modal -->
                <Modal v-model="showDeleteModal" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Delete confirmation</span>
                    </p>
                    <div style="text-align:center">
                        <p>Are you sure you want to delete?.</p>

                    </div>
                    <div slot="footer">
                        <Button type="error" size="large" long :loading="isDeleing" :disabled="isDeleing" @click="deleteItemBtn" >Delete</Button>
                    </div>
                </Modal>
                <!-- show alert modal -->
                <Modal v-model="showStatusModal" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Change Status</span>
                    </p>
                    <div style="text-align:center">
                        <p>Are you sure you want to change status?.</p>

                    </div>
                    <div slot="footer">
                        <Button type="success" size="large" long :loading="isStatus" :disabled="isStatus" @click="statusItemBtn">Change Status</Button>
                    </div>
                </Modal>
                <!-- show alert modal -->
                <Modal v-model="showShowModal" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Change Showing</span>
                    </p>
                    <div style="text-align:center">
                        <p>Are you sure you want to Showing or Not?.</p>
                    </div>
                    <div slot="footer">
                        <Button type="success" size="large" long :loading="isStatus" :disabled="isStatus" @click="showItemBtn">Show or Not</Button>
                    </div>
                </Modal>

            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data(){
            return {
                data : {
                    party_id: '',
                    account_id: '',
                    dr: '',
                    amount: '',
                },
                addModal : false,
                editModal : false,
                isAdding : false,
                setData : [],
                editData : {
                    party_id: '',
                    account_id: '',
                    dr: '',
                    amount: ''
                },
                index : -1,
                showDeleteModal: false,
                showStatusModal: false,
                showShowModal: false,
                isDeleing : false,
                isStatus : false,
                isShow: false,
                deleteItem: {},
                statusItem: {},
                deletingIndex: -1,
                websiteSettings: [],
                party: [],
                accounts: [],

            }
        },

        methods : {
            async getTransactions() {
                // Here, you can perform any action you need based on the updated value of selectedOption
                console.log('Selected option:', this.data.party_id);
                    if(this.data.party_id =='') return this.e('Please select Party')

                    const res = await this.callApi('post', 'api/party_account_transaction/store', this.data.party_id)
                    if(res.status===200){
                        const setItemData = res.data.data;
                        // this.setData.unshift(setItemData);
                        this.s('Items has been added successfully!');
                        this.addModal = false;
                        this.data.party_id = '';
                        this.data.account_id = '';
                        window.location.reload();
                    }else{
                        if(res.status==422){
                            for(let i in res.data.errors){
                                this.e(res.data.errors[i][0])
                            }
                        }else{
                            this.swr()
                        }
                    }
            },
            async addItem(){
                if(this.data.party_id =='') return this.e('Party Transaction is required')
                if(this.data.account_id =='') return this.e('Account is required')
                if(this.data.dr =='') return this.e('Debit is required')
                if(this.data.amount =='') return this.e('Credit is required')

                const res = await this.callApi('post', 'api/party_account_transaction/store', this.data)
                if(res.status===200){
                    const setItemData = res.data.data;
                    // this.setData.unshift(setItemData);
                    this.s('Items has been added successfully!');
                    this.addModal = false;
                    this.data.party_id = '';
                    this.data.account_id = '';
                    window.location.reload();
                }else{
                    if(res.status==422){
                        for(let i in res.data.errors){
                            this.e(res.data.errors[i][0])
                        }
                    }else{
                        this.swr()
                    }
                }
            },
            async editItemBtn(){
                if(this.editData.party_id =='') return this.e('Party Transaction is required')
                if(this.editData.account_id =='') return this.e('Account is required')
                if(this.editData.dr =='') return this.e('Please check Debit or credit is required')
                if(this.editData.amount =='') return this.e('Amount is required')

                const res = await this.callApi('post', 'api/party_account_transaction/update', this.editData)
                if(res.status===200){
                    this.setData[this.index] = this.editData;
                    this.s('Items has been edited successfully!')
                    this.editModal = false;
                }else{
                    if(res.status==422){
                        for(let i in res.data.errors){
                            this.e(res.data.errors[i][0])
                        }
                    }else{
                        this.swr()
                    }
                }
            },
            showEditModal(items, index){
                let obj = {
                    id : items.id,
                    party_id : items.party_id,
                    account_id : items.account_id,
                    dr : items.dr,
                    cr : items.cr,
                }
                this.editData = obj;
                this.editModal = true;
                this.index = index
            },
            async deleteItemBtn(){
                this.isDeleing = true;
                const res = await this.callApi('post', 'api/party_account_transaction/delete', this.deleteItem)
                if(res.status===200){
                    this.setData.splice(this.deleteItem,1)
                    this.s('Items has been deleted successfully!')
                }else{
                    this.swr()
                }
                this.isDeleing = false
                this.showDeleteModal = false

            },
            async statusItemBtn(){
                this.isStatus = true;
                const setIsActive = {'id':this.statusItem.id};
                const res = await this.callApi('post', 'api/party_account_transaction/updateIsActive', setIsActive)
                if(res.status===200){
                    // this.setData.splice(this.statusItem,1)
                    window.location.reload();

                    this.s('Items Status Change successfully!')
                }else{
                    this.swr()
                }
                this.isShow = false;
                this.showStatusModal = false;

            },async showItemBtn(){
                this.isStatus = true;
                const setIsShow = {'id':this.showItem.id};
                const res = await this.callApi('post', 'api/party_account_transaction/updateIsShow', setIsShow)
                if(res.status===200){
                    // this.setData.splice(this.statusItem,1)
                    window.location.reload();

                    this.s('Showing Status Change successfully!')
                }else{
                    this.swr()
                }
                this.isShow = false;
                this.showStatusModal = false;

            },
            showDeletingModal(items, i){
                this.deleteItem = items,
                    this.showDeleteModal =  true
            },
            showStatusesModal(items, i) {
                this.statusItem = items,
                    this.showStatusModal = true
            },
            showShowsModal(items, i){
                this.showItem = items,
                    this.showShowModal =  true
            }
        }, async created(){
            const [res, resParty,resAccount] = await Promise.all([
                this.callApi('get', 'api/party_account_transaction/listing'),
                this.callApi('get', 'api/party/listing'),
                this.callApi('get', 'api/account/listing'),
            ])
            if(res.status==200){
                console.log(res.data.data.data);
                this.setData = res.data.data.data;
            }else{
                this.swr()
            }
            if(resParty.status==200){
                this.party = resParty.data.data.data;
                console.log("IT JTEEE");
                console.log(this.party);
            }else{
                this.swr()
            }
            if(resAccount.status==200){
                this.accounts = resAccount.data.data.data;
            }else{
                this.swr()
            }
        }
    }
</script>
