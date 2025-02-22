<?php

/*
 * PocketFactions
 *
 * Copyright (C) 2015 LegendsOfMCPE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author LegendsOfMCPE
 */

namespace pocketfactions\faction;

interface Faction{
	/**
	 * Returns the faction's ID
	 *
	 * @return int
	 */
	public function getId();

	/**
	 * Returns the faction's name
	 * @return string
	 */
	public function getName();
}
