import { Injectable } from '@angular/core';
import { MiaProductChild } from '../entities/mia_product_child';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaProductChildService extends MiaBaseCrudHttpService<MiaProductChild> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_product_child';
  }
 
}