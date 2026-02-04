export interface PeopleDetails {
  created: string;
  edited: string;
  name: string;
  gender: string;
  skin_color: string;
  hair_color: string;
  height: string;
  eye_color: string;
  mass: string;
  homeworld: string;
  birth_year: string;
  vehicles: string[];
  starships: string[];
  films: string[];
  url: string;
}

export interface PeopleDetailsResponse {
  id: string | number;
  details: PeopleDetails;
}
