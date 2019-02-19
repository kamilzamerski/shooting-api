<?php

class ClubTest extends TestCase
{
    public function testGetClubList()
    {
        $this->get('/club');
        $this->assertResponseStatus(200);
    }

    public function testCreateClub()
    {
        $club = factory(\App\Models\ClubModel::class)->raw();
        $this->json('POST', '/club', $club)
            ->seeStatusCode(\Illuminate\Http\Response::HTTP_CREATED)
            ->seeInDatabase('club', ['name' => $club['name'], 'license_no' => $club['license_no']])
            ->seeJsonContains(['status' => true])
            ->seeJsonStructure(['status', 'data']);

        //UNIQUE CLUB
        $club = factory(\App\Models\ClubModel::class)->raw();
        $this->json('POST', '/club', $club);
        $this->json('POST', '/club', $club)
            ->seeStatusCode(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY)
            ->seeJsonContains(['license_no' => ['The license no has already been taken.']]);

        //NAME VALID
        $faker = \Faker\Factory::create();
        $club = factory(\App\Models\ClubModel::class)->raw([
            'name' => $faker->realText(100),
            'license_no' => $faker->randomNumber(2) . '/' . $faker->year()
        ]);
        $this->json('POST', '/club', $club)
            ->seeStatusCode(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY)
            ->seeJsonContains(['name' => ['The name may not be greater than 50 characters.']]);
    }

    public function testGetClub()
    {
        $clubFactory = factory(\App\Models\ClubModel::class)->raw();
        $jsonClub = json_decode($this->json('POST', '/club', $clubFactory)->response->getContent());
        $this->json('GET', '/club/'.$jsonClub->data->id)
            ->seeStatusCode(\Illuminate\Http\Response::HTTP_OK)
            ->seeJsonContains(['status' => true])
            ->seeJsonStructure(['status', 'data']);

        $this->json('GET', '/club/0')
            ->seeStatusCode(\Illuminate\Http\Response::HTTP_NOT_FOUND)
            ->seeJsonContains(['status' => false])
            ->seeJsonContains(['msg' => 'Club not found']);

        $this->json('GET', '/club/abc')
            ->seeStatusCode(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY)
            ->seeJsonContains(['id' => ['The id must be an integer.']]);
    }


    public function testDeleteClub()
    {
        $clubFactory = factory(\App\Models\ClubModel::class)->raw();
        $jsonClub = json_decode($this->json('POST', '/club', $clubFactory)->response->getContent());
        $this->json('DELETE', '/club/'.$jsonClub->data->id)
            ->seeStatusCode(\Illuminate\Http\Response::HTTP_OK)
            ->seeJsonContains(['status' => true]);

        $this->json('DELETE', '/club/0')
            ->seeStatusCode(\Illuminate\Http\Response::HTTP_NOT_FOUND)
            ->seeJsonContains(['status' => false])
            ->seeJsonContains(['msg' => 'Club not found']);

        $this->json('DELETE', '/club/abc')
            ->seeStatusCode(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY)
            ->seeJsonContains(['id' => ['The id must be an integer.']]);
    }
}