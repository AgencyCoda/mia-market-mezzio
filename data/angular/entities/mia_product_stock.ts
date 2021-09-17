import { MiaModel } from "@agencycoda/mia-core";

export class MiaProductStock extends MiaModel {
    id: number = 0;
    product_id: number = 0;
    user_id: number = 0;
    val: number = 0;
    type: number = 0;
    created_at: string = '';
    updated_at: string = '';

}