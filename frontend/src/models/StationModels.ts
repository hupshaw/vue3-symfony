export interface  Station {
  station_code: string;
  name: string;
  line_code_1: string;
  line_code_2: string | null;
  line_code_3: string | null;
}

//If expanding app: Add additional models relating to station data here