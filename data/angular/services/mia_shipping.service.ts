import { Injectable } from '@angular/core';
import { MiaShipping } from '../entities/mia_shipping';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaShippingService extends MiaBaseCrudHttpService<MiaShipping> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_shipping';
  }
 
}