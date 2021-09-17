import { Injectable } from '@angular/core';
import { MiaStore } from '../entities/mia_store';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaStoreService extends MiaBaseCrudHttpService<MiaStore> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_store';
  }
 
}