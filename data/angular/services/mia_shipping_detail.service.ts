import { Injectable } from '@angular/core';
import { MiaShippingDetail } from '../entities/mia_shipping_detail';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaShippingDetailService extends MiaBaseCrudHttpService<MiaShippingDetail> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_shipping_detail';
  }
 
}